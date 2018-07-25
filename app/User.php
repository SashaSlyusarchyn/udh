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
        );
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organizations_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'users_id', 'id');
    }
}
