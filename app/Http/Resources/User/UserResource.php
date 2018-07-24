<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Organization\OrganizationResource;
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
            'organization' => new OrganizationResource($this->organization)
        ];
    }
}
