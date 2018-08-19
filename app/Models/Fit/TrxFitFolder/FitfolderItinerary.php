<?php

namespace App\Models\Fit\TrxFitfolder;

use Illuminate\Database\Eloquent\Model;

class FitfolderItinerary extends Model
{
    protected $table = 'trx_fit_folder_itinerary';

    protected $fillable = [
    	'id_fit_folder',
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
