<?php

namespace App\Models\System\Core;

use Illuminate\Database\Eloquent\Model;

class CoreForm extends Model
{
    protected $table = 'core_form';

    protected $fillable = [
    	'core_module_id',
    	'form_name',
    	'form_url',
    	'form_label',
    	'form_code',
    	'printable_output'
    ];
}
