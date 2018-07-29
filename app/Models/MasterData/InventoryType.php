<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    protected $table = 'master_inventory_type';

    protected $fillable = [
    	'inventory_type_code',
    	'inventory_type_name',
    	'is_draft',
    	'company_id'
    ];
}
