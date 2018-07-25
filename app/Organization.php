<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'organizations_id', 'id');
    }
}
