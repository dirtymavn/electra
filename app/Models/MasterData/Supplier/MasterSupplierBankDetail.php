<?php

namespace App\Models\MasterData\Supplier;

use Illuminate\Database\Eloquent\Model;

class MasterSupplierBankDetail extends Model
{
    protected $table = 'master_supplier_bank_detail';

    protected $fillable = [
    	'supplier_bank_id',
    	'name',
    	'acc_no_1',
    	'acc_no_1_currency',
    	'iban_1',
    	'acc_no_2',
    	'acc_no_2_currency',
    	'iban_2',
    	'acc_no_3',
    	'acc_no_3_currency',
    	'iban_3',
    	'acc_no_4',
    	'acc_no_4_currency',
    	'iban_4',
    	'swift',
    	'bic',
    	'remark'
    ];
}