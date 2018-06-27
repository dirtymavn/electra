<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRouteCost extends Model
{
    protected $table = 'master_inventory_route_cost';

    protected $fillable = [
    	'master_inventory_id',
    	'cost_type',
    	'lg_no',
    	'departure',
    	'arrival',
    	'status'
    ];
}
