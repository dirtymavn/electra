<?php

namespace App\Models\MasterData\Supplier;

use Illuminate\Database\Eloquent\Model;

class MasterSupplierBankCrpd extends Model
{
    protected $table = 'master_supplier_bank_crpd';

    protected $fillable = [
    	'supplier_bank_id',
    	'name',
    	'address',
    	'ac_no',
    	'swift',
    	'remark'
    ];
}