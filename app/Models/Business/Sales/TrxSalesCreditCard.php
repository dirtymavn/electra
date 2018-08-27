<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSalesCreditCard extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_sales_credit_card';

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
