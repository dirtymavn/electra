<?php

namespace App\Models\System\Core;

use Illuminate\Database\Eloquent\Model;

class CoreModule extends Model
{
    protected $table = 'core_module';

    protected $fillable = [
    	'module_name',
    	'module_label',
    	'module_code',
    	'company_id',
    	'is_draft'
    ];
}
