<?php

namespace App\Models\Fit\TrxFitfolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FitfolderRate extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_fit_folder_rate';

    protected $fillable = [
    	'id_fit_folder',
	    'customer_type',
	    'price_type',
	    'group_size',
	    'price',
	    'discount',
	    'company_id',
	    'branch_id'
    ];

    
}
