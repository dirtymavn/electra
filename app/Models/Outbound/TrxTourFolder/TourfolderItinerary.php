<?php

namespace App\Models\Outbound\TrxTourfolder;

use Illuminate\Database\Eloquent\Model;

class TourfolderItinerary extends Model
{
    protected $table = 'trx_tour_folder_itinerary';

    protected $fillable = [
    	'id_tour_folder',
    	'day',
	    'itinerary_code',
	    'city',
	    'description',
	    'operator',
	    'breakfast',
	    'lunch',
	    'dinner',
	    'accomodation',
	    'notes',
	    'transport_detail',
	    'company_id',
	    'branch_id'
    ];
}
