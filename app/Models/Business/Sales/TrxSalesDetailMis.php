<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class TrxSalesDetailMis extends Model
{

	protected $table = 'trx_sales_detail_mis';

	protected $fillable = [
		'trx_sales_detail_id',
		'lowest_fare_rejection',
		'destination_id',
		'deal_code',
		'region_code_id',
		'realised_saving_code',
		'iata_no',
		'fare_type_id'
	];
}
