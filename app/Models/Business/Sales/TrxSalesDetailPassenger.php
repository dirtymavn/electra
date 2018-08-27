<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSalesDetailPassenger extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	protected $table = 'trx_sales_detail_passenger';

	protected $fillable = [
		'trx_sales_detail_id',
		'passenger_name',
		'ticket_no',
		'conj_ticket_no'
	];
}
