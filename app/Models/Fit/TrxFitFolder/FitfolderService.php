<?php

namespace App\Models\Fit\TrxFitfolder;

use Illuminate\Database\Eloquent\Model;

class FitfolderService extends Model
{
    protected $table = 'trx_fit_folder_service';

    protected $fillable = [
    	'id_fit_folder',
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