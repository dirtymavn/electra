<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Company extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'tax',
        'npwp',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user record associated with the company.
    */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'company_id');
    }

    /**
     * Get companies where has not user.
    */
    public static function scopeGetData($query)
    {
        return $query->whereDoesntHave('users');
    }

    public function customers()
    {
        return $this->hasMany('App\Models\Business\Customer', 'company_id');
    }

    /**
     * Get the branch record associated with the company.
    */
    public function branchs()
    {
        return $this->hasMany('App\Models\MasterData\Branch', 'company_id');
    }

    /**
     * Get the department record associated with the company.
    */
    public function departments()
    {
        return $this->hasMany('App\Models\MasterData\Department', 'company_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($company) {
            if ($company->branchs->count() > 0) {
                foreach ($company->branchs as $branch) {
                    $branch->delete();
                }
            }

            if ($company->departments->count() > 0) {
                foreach ($company->departments as $department) {
                    $department->delete();
                }
            }
        });
    }
}
