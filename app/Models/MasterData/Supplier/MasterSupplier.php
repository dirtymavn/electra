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

    public static function getAutoNumber()
    {
        $result = self::orderBy('id', 'desc')->first();

        $findCode = \DB::table('setting_codes')->whereType('SUP')->first();
        if ($result) {
            $lastNumber = (int) substr($result->supplier_no, strlen($result->supplier_no) - 4, 4);
            $newNumber = $lastNumber + 1;
            
            if (strlen($newNumber) == 1) {
                $newNumber = '000'.$newNumber;
            } elseif (strlen($newNumber) == 2) {
                $newNumber = '00'.$newNumber;
            } elseif (strlen($newNumber) == 3) {
                $newNumber = '0'.$newNumber;
            } else {
                $newNumber = $newNumber;
            }

            $currMonth = (int)date('m', strtotime($result->supplier_no));
            $currYear = (int)date('y', strtotime($result->supplier_no));
            $nowMonth = (int)date('m');
            $nowYear = (int)date('y');

            if ( ($currMonth < $nowMonth && $currYear == $nowYear) || ($currMonth == $nowMonth && $currYear < $nowYear) ) {
                $newNumber = '0001';
            } else {
                $newNumber = $newNumber;
            }

            $newCode = $findCode->type.$newNumber;
        } else {
            $newCode = $findCode->type.'0001';
        }

        return $newCode;
    }

    public static function types()
    {
        $types = [
            'Tipe 01' => 'Tipe 01',
            'Tipe 02' => 'Tipe 02',
            'Tipe 03' => 'Tipe 03',
            'Tipe 04' => 'Tipe 04',
            'Tipe 05' => 'Tipe 05',
            'Tipe 06' => 'Tipe 06',
            'Tipe 07' => 'Tipe 07'
        ];

        return $types;
    }

}
