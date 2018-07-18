<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class CoreStatus extends Model
{
    protected $table = 'master_core_status';

    protected $fillable = [
    	'status_name',
    	'status_code',
    	'status_order',
    	'status_approval_flag',
    	'company_id',
    	'is_draft'
    ];
}
