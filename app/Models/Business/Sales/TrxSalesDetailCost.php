<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class TrxSalesDetailCost extends Model
{

	protected $table = 'trx_sales_detail_cost';

	protected $fillable = [
		'trx_sales_detail_id',
		'pay_amt',
		'currency_code_id',
		'supplier_reference_id',
		'voucher_reference_id'
	];
}
