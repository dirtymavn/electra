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
}
