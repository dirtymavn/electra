<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;

class HotelBookingDetail extends Model
{
    protected $table = 'trx_hotel_booking_detail';

    protected $fillable = [
    	'id_hotel_booking',
		'id_room_type',
		'id_room_category',
		'room_number',
		'night',
		'price_per_night',
		'include_breakfast',
		'non_smooking',
		'high_floor',
		'company_id',
		'branch_id'
    ];  
}





           