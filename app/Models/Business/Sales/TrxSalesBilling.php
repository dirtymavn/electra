<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSalesBilling extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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