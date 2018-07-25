<?php

namespace App\Http\Resources\File;

use Illuminate\Http\Resources\Json\Resource;

class FileResource extends Resource
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
                'id' => $this->user->id,
                'name' => $this->user->name
            ],
            'created' => (string)$this->updated_at
        ];
    }
}
