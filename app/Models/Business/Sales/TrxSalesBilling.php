<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class TrxSalesBilling extends Model
{
    protected $table = 'trx_sales_billing';

    protected $fillable = [
    	'trx_sales_id',
    	'card_type',
    	'card_no',
    	'cardholder_name',
    	'expiry_date',
    	'security_id',
    	'merchant_no',
    	'roc_no',
    	'amount',
    	'sof_flag',
    	'authorisation_code',
    	'authorisation_date'
    ];
}