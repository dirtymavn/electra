<?php

namespace App\Models\Business\Delivery;

use Illuminate\Database\Eloquent\Model;

class DoType extends Model
{
    protected $table = 'do_types';

    protected $fillable = [
    	'do_type_name',
    	'do_type_code',
    	'do_type_status',
    	'company_id',
    	'is_draft'
    ];
}