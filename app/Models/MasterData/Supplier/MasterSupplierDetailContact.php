<?php

namespace App\Models\MasterData\Supplier;

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
