<?php

namespace App\Models\Business\Supplier;

use Illuminate\Database\Eloquent\Model;
use Request;

class MasterSupplier extends Model
{
    protected $table = 'master_supplier';

    protected $fillable = [
    	'supplier_no',
    	'supplier_type',
    	'name',
    	'address',
    	'status',
    	'hotel_vendor_flag',
    	'sundry_profile_flag'
    ];

    public function detail()
    {
    	return $this->belongsTo( MasterSupplierDetail::class );
    }

    public function bank()
    {
    	return $this->belongsTo( MasterSupplierBank::class );
    }

    protected static function boot()
    {
        parent::boot();

        static::created( function ( $supplier ) {
        	$input = Request::all();
            $input['master_supplier_id'] = $supplier->id;

            MasterSupplierDetail::create( $input );
            // MasterSupplierBank::create( $input );
        });
    }

}
