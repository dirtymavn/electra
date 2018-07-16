<?php

namespace App\Models\MasterData\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryCost extends Model
{
    protected $table = 'master_inventory_cost';

    protected $fillable = [
        'master_inventory_id',
    	'cost_type',
    	'lg_no',
    	'supplier_no',
    	'ticket_cost',
    	'published_r',
    	'exch_rate',
    	'tax',
    	'discount',
    	'comm_amt'
    ];
}
