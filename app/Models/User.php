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
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends CartalystUser implements Auditable, UserContract
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password','username','status','company_id', 'parent_id', 'company_role', 'avatar'
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
        $results = self::leftJoin('companies', 'companies.id', '=', 'users.company_id')
        ->join('role_users', 'role_users.user_id', '=', 'users.id');
        if (user_info()->roles[0]->slug != 'super-admin') {
            $results->whereNotIn('role_id', [1]);
        }
        if (user_info('company_role') == 'super-admin') {
            $results = $results->whereNull('users.parent_id')
                ->where('users.company_role', '<>','super-admin');
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
    
    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->getKey();
    }
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->getPersistCode();
    }
    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     *
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->persist_code = $value;
        $this->save();
    }
    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return "persist_code";
    }

    /**
     * Get user's profile by Username or Email.
     *
     * @return string
     */
    public static function findUser($uEmail)
    {
        return self::whereUsername($uEmail)
            ->orWhere('email', $uEmail)
            ->first();
    }

    public static function getPersistence($userId)
    {
        return \DB::table('persistences')->whereUserId($userId)->first();
    }

    /**
     * Get the masterProfile that owns the user.
    */
    public function masterProfile()
    {
        return $this->hasOne('App\Models\Internals\MasterProfile', 'user_id');
    }
}