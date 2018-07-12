<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class TrxSalesDetailSegment extends Model
{
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
