<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRoutePkg extends Model
{
    protected $table = 'master_inventory_route_pkg';

    protected $fillable = [
    	'master_inventory_id',
        'package_name',
        'start_date',
        'end_date',
        'status',
    ];
}
