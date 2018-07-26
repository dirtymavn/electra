<?php

namespace App\Models\System\Core;

use Illuminate\Database\Eloquent\Model;

class MasterCompanyForm extends Model
{
	protected $table = 'master_company_form';

	protected $fillable = [
		'master_company_id',
		'form_id',
		'form_label',
		'form_code'
	];
}
