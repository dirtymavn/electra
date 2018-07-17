<?php

namespace App\Models\Accounting\LG;

use Illuminate\Database\Eloquent\Model;

class MasterLGDetail extends Model
{
    protected $table = 'master_lg_detail';

    protected $fillable = [
    	'master_lg_id',
        'product_code',
        'product_code_description',
        'qty',
        'unit_cost',
        'total_amt',
        'discount',
        'tax',
        'gst_amt',
    ];
}
