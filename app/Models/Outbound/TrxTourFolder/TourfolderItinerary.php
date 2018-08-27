<?php

namespace App\Models\Outbound\TrxTourfolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourfolderItinerary extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

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
