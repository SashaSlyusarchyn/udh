<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'active'
    ];
}
