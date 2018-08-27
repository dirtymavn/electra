<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBookingDetail extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

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





           