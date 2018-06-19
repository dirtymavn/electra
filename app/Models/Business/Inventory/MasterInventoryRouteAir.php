<?php

namespace App\Models\Business\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRouteAir extends Model
{
    protected $table = 'master_inventory_route_air';

    protected $fillable = [
    	'master_inventory_id',
    	'route_from',
    	'route_to',
    	'airline_code',
    	'flight_no',
    	'class',
    	'farebasis',
    	'depart_date',
    	'arrival',
    	'departure',
    	'status',
    	'equip',
    	'stopover_city',
    	'stopover_qty',
    	'seat_no',
    	'airlane_pnr',
    	'fly_duration',
    	'meal_srv',
    	'terminal',
    	'ssr',
    	'sector_pair',
    	'miliage',
    	'path_code',
    	'land_sector_flag',
    	'land_sector_desc'
    ];
}
