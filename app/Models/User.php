<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;
use Cartalyst\Sentinel\Permissions\PermissibleInterface;
use Cartalyst\Sentinel\Permissions\PermissibleTrait;
use Cartalyst\Sentinel\Persistences\PersistableInterface;
use Cartalyst\Sentinel\Roles\RoleableInterface;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Illuminate\Database\Eloquent\Model;

class User extends CartalystUser
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'created_at', 'updated_at',
    ];
}
