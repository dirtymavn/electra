<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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
    public function user()
    {
        return $this->hasOne('App\Models\User', 'company_id');
    }

    /**
     * Get companies where has not user.
    */
    public static function scopeGetData($query)
    {
        return $query->whereDoesntHave('user');
    }
}
