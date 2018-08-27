<?php

namespace App\Models\Fit\TrxFitfolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitfolderItinerary extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

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
