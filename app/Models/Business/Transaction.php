<?php

namespace App\Models\Business;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Transaction extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    const PENDING = 0;
    const APPROVE = 1;
    const REJECT = 2;

    protected $table = 'transactions';

    protected $fillable = [
        'customer_id',
        'company_id',
        'status',
        'code'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function company() {
        return $this->belongsTo('App\Models\Master\Company', 'company_id');
    }

    public function getDataByCompany($companyId = null)
    {
        $results = self::join('companies', 'companies.id', '=', 'transactions.company_id')
            ->join('customers', 'customers.id', '=', 'transactions.customer_id');
        if ($companyId) {
            $results = $results->where('transactions.company_id', $companyId);
        } else {
            $results = $results->whereNotNull('transactions.company_id');
        }

        return $results;
    }
}
