<?php

namespace App\Models\System\Core;

use Illuminate\Database\Eloquent\Model;

class CoreReport extends Model
{
    protected $table = 'core_report';

    protected $fillable = [
    	'core_module_id',
    	'report_name',
    	'report_url',
    	'report_label',
    	'report_code'
    ];
}
