<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelBookingPax extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

    

           