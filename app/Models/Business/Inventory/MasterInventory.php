<?php

namespace App\Models\Business\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventory extends Model
{
    protected $table = 'master_inventory';

    protected $fillable = [
    	'trx_sales_id',
    	'inventory_type',
    	'voucher_no',
    	'product_code',
    	'recevied_date',
    	'booked_qty',
    	'sold_qty',
    	'status',
    	'qty',
    	'guest_name',
    	'iata_no',
    	'tour_code',
    	'coupon_no',
    	'nights',
    	'rooms',
    	'is_draft'
    ];
}
