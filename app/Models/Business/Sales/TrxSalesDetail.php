<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSalesDetail extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_sales_detail';

    protected $fillable = [
    	'trx_sales_id',
    	'product_code',
    	'passenger_class_code',
    	'is_group_flag',
    	'is_suppress_flag',
    	'is_pax_sup',
    	'is_group_item',
    	'pnr_no',
    	'dk_no',
    	'airline_from',
    	'sales_type',
    	'sales_detail_remark',
    	'confirm_by',
    	'confirm_date',
    	'mpd_no'
    ];
}
