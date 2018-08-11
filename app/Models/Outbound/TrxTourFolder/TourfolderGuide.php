<?php

namespace App\Models\Outbound\TrxTourfolder;

use Illuminate\Database\Eloquent\Model;

class TourfolderGuide extends Model
{
    protected $table = 'trx_tour_folder_guide';

    protected $fillable = [
    	'id_tour_guide',
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
