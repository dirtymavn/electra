<?php

namespace App\Models\Business\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryCost extends Model
{
    protected $table = 'master_inventory_cost';

    protected $fillable = [
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
