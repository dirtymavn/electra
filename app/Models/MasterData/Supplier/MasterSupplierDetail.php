<?php

namespace App\Models\MasterData\Supplier;

use Illuminate\Database\Eloquent\Model;

use Request;

class MasterSupplierDetail extends Model
{
    protected $table = 'master_supplier_detail';

    protected $fillable = [
    	'master_supplier_id',
    	'credit_days',
    	'credit_limit',
    	'credit_term_type',
    	'default_payee',
    	'gst_id',
    	'gst_registration_no',
    	'interface_no',
    	'service_provided',
    	'trading_currency',
    	'xo_calculated_by'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created( function ( $supplier ) {
        	$input = Request::all();
        	$input['master_supplier_detail_id'] = $supplier->id;

        	MasterSupplierDetailContact::create($input);
        });
	}
}
