<?php

namespace App\Models\Fit\TrxFitfolder;

use Illuminate\Database\Eloquent\Model;

class FitfolderGuide extends Model
{
    protected $table = 'trx_fit_folder_guide';

    protected $fillable = [
    	'id_fit_folder',
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
