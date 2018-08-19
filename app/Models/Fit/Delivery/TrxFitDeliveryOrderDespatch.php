<?php

namespace App\Models\Fit\Delivery;

use Illuminate\Database\Eloquent\Model;

class TrxFitDeliveryOrderDespatch extends Model
{
    
	protected $table = 'trx_fit_delivery_order_despatchs';

	protected $fillable = [
		'trx_fit_delivery_order_id',
		'despatch_staff',
		'despatch_time',
		'instruction',
		'related_so',
		'to_area',
		'to_delivery',
		'to_collect',
		'received_by',
		'date_received'
	];
}
