<?php

namespace App\Http\Resources\File;

use App\Http\Resources\SecreLevel\SecretLevelResource;
use Illuminate\Http\Resources\Json\Resource;

class AvailableFileResource extends Resource
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
            'name' => $this->original_name,
            'owner' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'department' => $this->user->department->name,
                'organization' => $this->user->department->organization->name,
            ],
            'secret_level' => new SecretLevelResource($this->secretLevel),
            'created' => (string)$this->updated_at
        ];
    }
}
