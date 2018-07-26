<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\User\UserIndexGetRequest;
use App\Http\Requests\Api\User\UserStorePostRequest;
use App\Http\Requests\Api\User\UserUpdatePasswordPutRequest;
use App\Http\Requests\Api\User\UserUpdatePutRequest;
use App\Http\Resources\User\UserResource;
use App\User;
use App\Http\Controllers\Controller;
use http\Env\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserIndexGetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(UserIndexGetRequest $request)
    {
        if (auth()->user()->hasRole('Admin')) {
            $user = (new User)->newQuery();
            if ($request->has('departments_id')) {
                $departments_id = $request->departments_id;
                $user->whereHas('department', function ($query) use ($departments_id) {
                    return $query->where('id', $departments_id);
                });
            }
            if ($request->has('organizations_id')) {
                $organizations_id = $request->organizations_id;
                $user->whereHas('department', function ($queryDepartment) use ($organizations_id) {
                    return $queryDepartment->whereHas('organization', function ($queryOrganization) use ($organizations_id) {
                        return $queryOrganization->where('id', $organizations_id);
                    });
                });
            }
            $users = $user->with('roles')
                ->with(['department' => function($query) {
                    return $query->with('organization');
                }])
                ->paginate(config('api.users_pp'));
            $this->data['users'] = UserResource::collection($users);
            $this->data['total'] = $users->total();
        } else {
            $this->data['users'] = [];
        }
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
     * @param UserStorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStorePostRequest $request)
    {
        $user = User::create([
            'departments_id' => $request->departments_id,
            'secret_levels_id' => $request->secret_levels_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'active' => $request->active
        ]);
        $this->data['user'] = new UserResource($user);
        return response()->json($this->makeResponse());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @param UserUpdatePutRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdatePutRequest $request, $id)
    {
        if (auth()->user()->hasRole('Admin')) {
            $user = User::find($id)->update([
                'departments_id' => $request->departments_id,
                'secret_levels_id' => $request->secret_levels_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'active' => $request->active
            ]);
            $this->data['user'] = new UserResource($user);
        } else {
            $this->data['user'] = [];
        }
        return response()->json($this->makeResponse());
    }

    public function updatePassword(UserUpdatePasswordPutRequest $request)
    {
        try {
            $user = auth()->user();
            $user->password = bcrypt($request->password);
            $user->save();
            $this->data['password_updated'] = true;
        } catch (\Exception $e) {
            $this->data['password_updated'] = false;
        }
        return response()->json($this->makeResponse());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->roles()->detach();
        $user->ownFiles()->delete();
        $user->availableFiles()->detach();
        $user->delete();
        return response()->json($this->makeResponse());
    }
}
