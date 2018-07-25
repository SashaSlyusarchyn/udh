<?php

namespace App;

use App\Traits\Uuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Uuids;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'users_has_roles',
            'users_id',
            'roles_id'
        )->where('active', true);
    }

    public function secretTypes()
    {
        return $this->belongsToMany(
            SecretType::class,
            'users_has_secret_types',
            'users_id',
            'secret_types_id'
        )->where('active', true);
    }

    public function hasRole($role)
    {
        return null !== $this->roles()
                ->where('role', $role)
                ->where('active', true)
                ->first();
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'id', 'departments_id')
            ->where('active', true);
    }

    public function ownFiles()
    {
        return $this->hasMany(File::class, 'users_id', 'id');
    }

    public function availableFiles()
    {
        return $this->belongsToMany(
            File::class,
            'users_has_files',
            'users_id',
            'files_id'
        );
    }
}
