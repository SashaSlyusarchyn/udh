<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Department\DepartmentResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\SecretType\SecretTypeResource;
use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->roles),
            'department' => new DepartmentResource($this->department),
            'secret_types' => SecretTypeResource::collection($this->secretTypes)
        ];
    }
}
