<?php

namespace App\Models\Business\Inventory;

use Illuminate\Database\Eloquent\Model;

class MasterInventoryRouteCarTransfer extends Model
{
    protected $table = 'master_inventory_route_car_transfer';

    protected $fillable = [
    	'master_inventory_id',
    	'city',
    	'company_code',
    	'vehicle',
    	'days_hired',
    	'pickup_date',
    	'pickup_location',
    	'dropoff_date',
    	'dropoff_location',
    	'status',
    	'rate_type'
    ];
}
