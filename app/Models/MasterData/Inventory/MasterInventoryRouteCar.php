<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRouteCar extends Model
{
    protected $table = 'master_inventory_route_car';

    protected $fillable = [
    	'master_inventory_id',
    	'from',
    	'to',
        'company',
    	'supplier_code',
    	'class',
    	'departure',
    	'arrival',
    	'status'
    ];
}
