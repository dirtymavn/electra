<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class TrxSalesBilling extends Model
{
    protected $table = 'trx_sales_billing';

    protected $fillable = [
    	'trx_sales_id',
        'ta_no',
        'cc_id',
        'purpose_code',
        'prcj_no',
        'department',
        'employee_no',
        'account_no',
        'job_title',
    ];
}