<?php

namespace App\Models\Outbound\TrxTourfolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourfolderGuide extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_tour_folder_guide';

    protected $fillable = [
    	'id_tour_folder',
	    'from_date',
	    'to_date',
	    'guide_number',
	    'title',
	    'name',
	    'notes',
	    'cash_advance',
	    'cash_return',
	    'company_id',
	    'branch_id'
    ];
}
