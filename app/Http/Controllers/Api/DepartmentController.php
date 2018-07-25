<?php

namespace App\Http\Controllers\Api;

use App\Department;
use App\Http\Requests\Api\Department\DepartmentIndexGetRequest;
use App\Http\Resources\Department\DepartmentResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param DepartmentIndexGetRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(DepartmentIndexGetRequest $request)
    {
        $department = (new Department)->newQuery();
        if ($request->has('organizations_id'))
            $department->where('organizations_id', $request->organizations_id);

//        $departments = $department->paginate(config('api.departments_pp'));
        $departments = $department->get();
        $this->data['departments'] = DepartmentResource::collection($departments);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
