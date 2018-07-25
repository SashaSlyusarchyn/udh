<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $fillable = [
//        'departments_id',
        'name',
        'description',
        'active'
    ];

    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organizations_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'departments_id', 'id');
    }

    public function activeUsers()
    {
        return $this->hasMany(User::class, 'departments_id', 'id')
            ->where('active', true);
    }

    public function departmentFiles()
    {
        return $this->belongsToMany(
            File::class,
            'departments_has_files',
            'departments_id',
            'files_id'
        );
    }
}
