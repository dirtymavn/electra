<?php

namespace App\Models\Fit\Delivery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxFitDeliveryOrderCustomer extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_fit_delivery_order_customers';

    protected $fillable = [
    	'trx_fit_delivery_order_id',
    	'customer_no',
    	'customer_address',
    	'tel_no',
    	'attn'
    ];
}