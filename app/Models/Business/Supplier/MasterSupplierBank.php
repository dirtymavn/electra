<?php

namespace App\Models\Business\Supplier;

use Illuminate\Database\Eloquent\Model;

class MasterSupplierBank extends Model
{
    protected $fillable = 'master_supplier_bank';

    protected $table = [
    	'address',
    	'bank_code',
    	'city',
    	'country',
    	'master_supplier_id',
    	'name',
    	'remark'
    ];
}
