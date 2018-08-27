<?php

namespace App\Models\Business\Sales;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxSalesDetailRouting extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_sales_detail_routing';

    
    protected $fillable = [
    	'trx_sales_detail_id',
    	'city_from_id',
    	'city_to_id',
    	'airline_id',
    	'passenger_class_id',
    	'depart_date',
    	'arrival_date',
    	'stopover_count',
    	'airline_pnr',
    	'fly_hr',
    	'meal_srv',
    	'ssr',
    	'sector_pair',
    	'path_code',
    	'land_sector_desc',
    	'operating_carrier_id',
    	'flight_no',
    	'flight_status',
    	'equip',
    	'seat_no',
    	'terminal',
    	'mileage',
    	'land_sector_flag',
    	'stopover',
    	'nuc',
    	'roe'
    ];
}
