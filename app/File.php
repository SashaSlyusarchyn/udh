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
        return $this->hasOne(User::class, 'id', 'users_id')
            ->where('active', true);
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'users_has_files',
            'files_id',
            'users_id'
        );
    }

    public function departments()
    {
        return $this->belongsToMany(
            Department::class,
            'departments_has_files',
            'files_id',
            'departments_id');
    }

    public function organizations()
    {
        return $this->belongsToMany(
            Organization::class,
            'organizations_has_files',
            'files_id',
            'organizations_id');
    }
}
