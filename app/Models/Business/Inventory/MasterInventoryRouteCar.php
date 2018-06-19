<?php

namespace App\Models\Business\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRouteCar extends Model
{
    protected $table = 'master_inventory_route_car';

    protected $fillable = [
    	'master_inventory_id',
    	'from',
    	'to',
    	'company',
    	'class',
    	'departure',
    	'arrival',
    	'status'
    ];
}
