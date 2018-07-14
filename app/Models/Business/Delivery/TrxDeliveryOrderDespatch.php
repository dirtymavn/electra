<?php

namespace App\Models\Business\Delivery;

use Illuminate\Database\Eloquent\Model;

class TrxDeliveryOrderDespatch extends Model
{
    
	protected $table = 'trx_delivery_order_despatchs';

	protected $fillable = [
		'trx_delivery_order_id',
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
