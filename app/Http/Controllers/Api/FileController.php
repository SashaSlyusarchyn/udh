<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ProcessingException;
use App\File;
use App\Http\Requests\Api\File\FileIndexGetRequest;
use App\Http\Requests\Api\File\FileStorePostRequest;
use App\Http\Resources\File\AvailableFileResource;
use App\Http\Resources\File\FileResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

/**
 * @resource File
 * Methods for working with files
 * @package App\Http\Controllers\Api->id
 */
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FileIndexGetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(FileIndexGetRequest $request)
    {
        $user = $user = tap(auth()->user(), function ($user) {
            $user->department->organization;
        });
        if ($request->has('available_files')) {
            $files = File::where('active', true)
                ->whereHas('users', function ($query) use ($user) {
                    return $query->where('users.id', $user->id);
                })
                ->orWhereHas('departments', function ($query) use ($user) {
                    return $query->where('departments.id', $user->department->id);
                })
                ->orWhereHas('organizations', function ($query) use ($user) {
                    return $query->where('organizations.id', $user->department->organization->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(config('api.files_pp'));
            $this->data['files'] = AvailableFileResource::collection($files);
        } else {
            $files = File::with('user')
                ->whereHas('user', function ($query) use ($user) {
                    return $query->where('id', $user->id);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(config('api.files_pp'));
            $this->data['files'] = FileResource::collection($files);
        }

        $this->data['total'] = $files->total();
        return response()->json($this->makeResponse());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FileStorePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileStorePostRequest $request)
    {
        $userFile = $request->file('file');
        $fileName = $userFile->store('', 'udh');
        $user = auth()->user();
        $file = $user->ownFiles()->create([
            'original_name' => $userFile->getClientOriginalName(),
            'hash_name' => $fileName,
            'active' => true
        ]);
        $this->data['file'] = new FileResource($file);
        return response()->json($this->makeResponse());
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = File::with('user')->find($id);
        $this->data['file'] = new FileResource($file);
        return response()->json($this->makeResponse());
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws ProcessingException
     */
    public function download($id)
    {
        try {
            $file = File::findOrFail($id);
        } catch (\Exception $e) {
            throw new ProcessingException(1, 'File not found', [], 200);
        }
        if (Storage::disk('udh')->exists($file->hash_name)) {
            $userFile = Storage::disk('udh')->get($file->hash_name);
        } else {
            throw new ProcessingException(1, 'File not found', [], 200);
        }
        return response($userFile, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="'.$file->original_name.'"',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws ProcessingException
     */
    public function destroy($id)
    {
        try {
            $file = File::findOrFail($id);
        } catch (\Exception $e) {
            throw new ProcessingException(1, 'File not found', [], 200);
        }
        if (Storage::disk('udh')->exists($file->hash_name)) {
            Storage::disk('udh')->delete($file->hash_name);
            $file->delete();
        } else {
            throw new ProcessingException(1, 'File not found', [], 200);
        }
        $this->data['file_destroyed'] = true;
        return response()->json($this->makeResponse());
    }
}
