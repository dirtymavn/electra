<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRouteHotel extends Model
{
    protected $table = 'master_inventory_route_hotel';

    protected $fillable = [
    	'master_inventory_id',
    	'city',
    	'hotel_name',
    	'hotel_chain',
    	'phone',
    	'fax',
    	'checkin_date',
    	'checkout_date',
    	'status',
    	'rm_type',
    	'rm_cat',
    	'guest_prm',
    	'meals',
    	'other_svc',
    	'ref_code',
    	'confirmation_code',
    	'address',
    	'remark'
    ];
}
