<?php

namespace App\Models\Outbound\Visa;

use Illuminate\Database\Eloquent\Model;

class VisaDocument extends Model
{
    protected $table = 'master_visa_document';

    protected $fillable = [
    	'master_visa_id',
		'document_type',
		'document_uri',
		'company_id',
		'branch_id'
    ];  
}