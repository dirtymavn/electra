<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;

class HotelBookingService extends Model
{
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
    

           