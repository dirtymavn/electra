<?php

namespace App\Models\MasterData\Supplier;

use Illuminate\Database\Eloquent\Model;
use Request;
use OwenIt\Auditing\Contracts\Auditable;

class MasterSupplier extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'master_supplier';

    protected $fillable = [
    	'supplier_no',
    	'supplier_type',
    	'name',
    	'address',
    	'status',
    	'hotel_vendor_flag',
    	'sundry_profile_flag',
        'is_draft',
        'company_id',
        'branch_id'
    ];

    public function detail()
    {
    	return $this->hasOne( MasterSupplierDetail::class );
    }

    public function bank()
    {
    	return $this->hasOne( MasterSupplierBank::class );
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

    /**
     * Get available supplier
     *
     * @return array
     */
    public static function getAvailableData()
    {
        $return = self::join('companies', 'companies.id', '=', 'master_supplier.company_id')
            ->where('master_supplier.is_draft', false);

        // if (user_info()->inRole('admin')) {
            $return = $return->where('master_supplier.company_id', user_info('company_id'));
        // }

        return $return;

    }

}
