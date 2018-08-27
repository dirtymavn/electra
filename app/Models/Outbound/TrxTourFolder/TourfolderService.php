<?php

namespace App\Models\Outbound\TrxTourfolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourfolderService extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that should be mutated to dates.
	 *
	 * @var array
	 */
	protected $dates = ['deleted_at'];

    protected $table = 'trx_tour_folder_service';

    protected $fillable = [
    	'id_tour_folder',
	    'id_product',
	    'service_type',
	    'charge_method',
	    'id_currency',
	    'id_supplier',
	    'notes',
		'company_id',
		'branch_id'
    ];
}