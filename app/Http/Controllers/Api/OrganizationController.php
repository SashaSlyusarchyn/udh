<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Organization\OrganizationStorePostRequest;
use App\Http\Requests\Api\Organization\OrganizationUpdatePutRequest;
use App\Http\Resources\Organization\OrganizationResource;
use App\Organization;
use App\Http\Controllers\Controller;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: pagination
//        $organizations = Organization::paginate(config('api.organizations_pp'));
        $organizations = Organization::all();
        $this->data['organizations'] = OrganizationResource::collection($organizations);

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
     * @param OrganizationStorePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrganizationStorePostRequest $request)
    {
        $organization = Organization::create($request->only(['name']));
        $this->data['organization'] = new OrganizationResource($organization);
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
        $this->data['organization'] = new OrganizationResource(Organization::find($id));
        return response()->json($this->makeResponse());
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
     * @param OrganizationUpdatePutRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganizationUpdatePutRequest $request, $id)
    {
        $organization = Organization::find($id)->update($request->only(['name']));
        $this->data['organization'] = new OrganizationResource($organization);
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
        //TODO: soft delete
        $this->data['soft_delete'] = false;
        return response()->json($this->makeResponse());
    }
}
