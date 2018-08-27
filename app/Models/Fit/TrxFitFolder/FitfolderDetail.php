<?php

namespace App\Models\Fit\TrxFitfolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitfolderDetail extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_fit_folder_detail';

    protected $fillable = [
    	'id_fit_folder',
	    'tour_category',
	    'tour_type',
	    'id_airlines',
	    'description',
	    'min_capacity',
	    'max_capacity',
	    'number_of_days',
	    'cut_of_date',
	    'ticket_dateline',
	    'deposit_dateline',
	    'id_currency',
	    'origin',
	    'company_id',
	    'branch_id'
    ];  
}
