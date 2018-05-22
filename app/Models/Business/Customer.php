<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'company_id',
        'name',
        'address',
        'created_at',
        'updated_at',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Master\Company');
    }

    public function getDataByCompany($companyId)
    {
        return self::whereCompanyId($companyId);
    }
}
