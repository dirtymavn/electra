<?php

namespace App\Models\Business\Supplier;

use Illuminate\Database\Eloquent\Model;

class MasterSupplierDetailContact extends Model
{
    protected $table = 'master_supplier_detail_contact';

    protected $fillable = [
    	'email',
    	'fax',
    	'given_name',
    	'master_supplier_detail_id',
    	'phone',
    	'surname',
    	'title'
    ];
}
