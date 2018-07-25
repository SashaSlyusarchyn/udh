<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
        'original_name',
        'hash_name',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

}
