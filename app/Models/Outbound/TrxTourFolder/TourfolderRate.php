<?php

namespace App\Models\Outbound\TrxTourfolder;

use Illuminate\Database\Eloquent\Model;

class TourfolderRate extends Model
{
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
