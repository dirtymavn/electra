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
        'first_name', 'last_name', 'email', 'password','username','status','company_id', 'parent_id', 'company_role'
    ];

    protected $loginNames = ['username'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'updated_at',
    ];

    /**
     * Get user's profile picture.
     *
     * @return string
     */
    public function isSuperAdmin() {
        if ( $this->roles[0]->slug == 'super-admin' ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * The roles that belong to the user.
     */
   public function role()
   {
       return $this->belongsToMany('App\Models\Role', 'role_users');
   }

   /**
     * Get the company that owns the user.
    */
   public function company()
    {
        return $this->belongsTo('App\Models\Master\Company');
    }

    /**
     * Get the childs of user.
    */
    public function childs()
    {
        return $this->hasMany('App\Models\User', 'parent_id');
    }

    /**
     * Get the parent of user.
    */
    public function parent()
    {
        return $this->belongsTo('App\Models\User', 'parent_id', 'id');
    }

    /**
     * Get user under company.
    */
   public function usersUnderCompany()
    {
        $results = self::leftJoin('companies', 'companies.id', '=', 'users.company_id');
        if (user_info('company_role') == 'super-admin') {
            $results = $results;
        } else {
            if (user_info()->parent) {
                $id = user_info()->parent->id;
                $results = $results->where('users.parent_id', $id)
                    ->whereNotIn('users.id', [user_info('id')]);
            } else {
                $id = user_info('id');
                $results = $results->where('users.parent_id', $id);

            }
        }

        return $results;
    }
   
}