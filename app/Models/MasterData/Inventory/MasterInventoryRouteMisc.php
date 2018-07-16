<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRouteMisc extends Model
{
    protected $table = 'master_inventory_route_misc';

    protected $fillable = [
    	'master_inventory_id',
        'description',
        'start_date',
        'end_date',
        'start_desc',
        'end_desc',
        'status',
    ];
}
