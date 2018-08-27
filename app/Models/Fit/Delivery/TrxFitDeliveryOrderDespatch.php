<?php

namespace App\Models\Fit\Delivery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxFitDeliveryOrderDespatch extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

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
