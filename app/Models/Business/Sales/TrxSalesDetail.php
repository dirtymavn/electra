<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;

class TrxSalesDetail extends Model
{
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
