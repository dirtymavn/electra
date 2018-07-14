<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class TrxSalesDetailPrice extends Model
{

	protected $table = 'trx_sales_detail_price';

	protected $fillable = [
		'trx_sales_detail_id',
		'description',
		'billing_currency_id',
		'gst_id',
		'gst_percent',
		'gst_amt',
		'rebate_percent',
		'rebate_amt',
	];
}
