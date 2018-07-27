<?php

namespace App\Models\MasterData\Supplier;

use Illuminate\Database\Eloquent\Model;

class MasterSupplierBank extends Model
{
    protected $table = 'master_supplier_bank';

    protected $fillable = [
    	'address',
    	'bank_code',
    	'city',
    	'country',
    	'master_supplier_id',
    	'name',
    	'remark'
    ];

    public function bank_detail()
    {
        return $this->belongsTo( MasterSupplierBankDetail::class, 'id', 'supplier_bank_id' );
    }

    public function crpd()
    {
        return $this->belongsTo( MasterSupplierBankCrpd::class, 'id', 'supplier_bank_id' );
    }
}
