<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;

class HotelBookingPax extends Model
{
    protected $table = 'trx_hotel_booking_pax';

    protected $fillable = [
	    'id_hotel_booking',
        'title',
        'pax_name',
        'type',
        'id_nationality',
	    'company_id',
	    'branch_id'
    ];  
}

    

           