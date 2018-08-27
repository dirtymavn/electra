<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSalesDetailSegment extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	protected $table = 'trx_sales_detail_segments';

	protected $fillable = [
		'trx_sales_detail_id',
		'description',
		'start_date',
		'end_date',
		'start_description',
		'end_description',
		'status'
	];
}
