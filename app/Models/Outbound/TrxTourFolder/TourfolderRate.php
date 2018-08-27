<?php

namespace App\Models\Outbound\TrxTourfolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourfolderRate extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_tour_folder_rate';

    protected $fillable = [
    	'id_tour_folder',
	    'customer_type',
	    'price_type',
	    'group_size',
	    'price',
	    'discount',
	    'company_id',
	    'branch_id'
    ];

    
}
