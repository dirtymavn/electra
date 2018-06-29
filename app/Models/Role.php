<?php

namespace App\Models;

use Cartalyst\Sentinel\Roles\EloquentRole as Model;
use Cviebrock\EloquentSluggable\Sluggable;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Sluggable;
    /**
     * {@inheritDoc}
     */
    protected $fillable = [
        'name', 'slug', 'permissions', 'company_id'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Return user's query for Datatables.
     *
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function datatables()
    {
        return static::select( 'name', 'slug', 'id' )->where('slug','!=','super-admin');
    }

    /**
     * Role User Belong To Many User Table
     */
    public function UserRoles()
    {
        return $this->belongsToMany( User::class , 'role_users', 'role_id');
    }

    /**
     * Get the permission based on role ID.
     * @author Yoga <thetaramolor@gmail.com>
     * @param  int   $id
     * @return array
     */
    public function getPermissionsKey($id)
    {
        $permissions = [];
        foreach (static::findOrFail($id)->permissions as $key => $value) {
            $permissions[] = $key;
        }
        return $permissions;
    }

    /**
    * The directories belongs to broadcasts.
    * @author  Yoga <thetaramolor@gmail.com>
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function users()
    {
        return $this->belongsToMany( User::class, 'role_users' );
    }
}
