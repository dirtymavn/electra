<?php

namespace App\Models\Hotel;

use Illuminate\Database\Eloquent\Model;

class HotelBookingRemark extends Model
{
    protected $table = 'trx_hotel_booking_remark';

    protected $fillable = [
    	'id_hotel_booking',
	    'remark',
	    'internal_notes',
	    'accounting_notes',
	    'cancel_notice',
	    'reference_number',
	    'tnr_number',
	    'company_id',
	    'branch_id'
    ];  
}
    

           