<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSalesDetailCost extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

	protected $table = 'trx_sales_detail_cost';

	protected $fillable = [
		'trx_sales_detail_id',
		'pay_amt',
		'currency_code_id',
		'supplier_reference_id',
		'voucher_reference_id'
	];
}
