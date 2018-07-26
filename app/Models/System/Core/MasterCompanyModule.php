<?php

namespace App\Models\System\Core;

use Illuminate\Database\Eloquent\Model;

class MasterCompanyModule extends Model
{
    protected $table = 'master_company_modules';

    protected $fillable = [
    	'master_company_id',
    	'core_module_id',
    	'module_label',
    	'module_code'
    ];
}
