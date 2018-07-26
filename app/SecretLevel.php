<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class SecretLevel extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'level',
        'active'
    ];
}
