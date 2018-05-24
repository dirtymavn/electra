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

    public static function getDataByCompany($companyId = null)
    {
        $results = self::join('companies', 'companies.id', '=', 'customers.company_id');
        if ($companyId) {
            $results = $results->where('customers.company_id', $companyId);
        } else {
            $results = $results->whereNotNull('customers.company_id');
        }

        return $results;
    }
}
