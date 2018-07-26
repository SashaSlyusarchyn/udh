<?php

namespace App\Http\Resources\SecreLevel;

use Illuminate\Http\Resources\Json\Resource;

class SecretLevelResource extends Resource
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
            'level' => $this->level
        ];
    }
}
