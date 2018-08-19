<?php

namespace App\Models\Fit\TrxFitfolder;

use Illuminate\Database\Eloquent\Model;

class FitfolderRate extends Model
{
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
