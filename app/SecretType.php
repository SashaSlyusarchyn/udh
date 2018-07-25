<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class SecretType extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'type',
        'active'
    ];
}
