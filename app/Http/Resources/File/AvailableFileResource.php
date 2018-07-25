<?php

namespace App\Http\Resources\File;

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
            'created' => (string)$this->updated_at
        ];
    }
}
