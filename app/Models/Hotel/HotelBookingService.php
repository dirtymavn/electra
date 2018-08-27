<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBookingService extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = 'trx_hotel_booking_service';

    protected $fillable = [
    	'id_hotel_booking',
    	'id_hotel_service',
        'service_code',
        'service_description',
        'quantity',
        'quantity_order',
        'order_date',
        'total_sales',
	    'company_id',
	    'branch_id'
    ];  
}
    

           