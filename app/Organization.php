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
        'description',
        'active'
    ];

    public function departments()
    {
        return $this->hasMany(Department::class, 'organizations_id', 'id');
    }

    public function activeDepartments()
    {
        return $this->hasMany(Department::class, 'organizations_id', 'id')
            ->where('active', true);
    }

    public function organizationFiles()
    {
        return $this->belongsToMany(
            File::class,
            'organizations_has_files',
            'organizations_id',
            'files_id'
        );
    }
}
