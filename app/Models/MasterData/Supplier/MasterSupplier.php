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

            $detail = new MasterSupplierDetail;
            $detail->master_supplier_id = $supplier->id;
            $detail->credit_days = $input['credit_days'];
            $detail->credit_limit = $input['credit_limit'];
            $detail->credit_term_type = $input['credit_term_type'];
            $detail->default_payee = $input['default_payee'];
            $detail->gst_id = $input['gst_id'];
            $detail->gst_registration_no = $input['gst_registration_no'];
            $detail->interface_no = $input['interface_no'];
            $detail->service_provided = $input['service_provided'];
            $detail->trading_currency = $input['trading_currency'];
            $detail->xo_calculated_by = $input['xo_calculated_by'];

            $detail->save();

            $contact = new MasterSupplierDetailContact;
            $contact->email = $input['email'];
            $contact->fax = $input['fax'];
            $contact->given_name = $input['given_name'];
            $contact->master_supplier_detail_id = $detail->id;
            $contact->phone = $input['phone'];
            $contact->surname = $input['surname'];
            $contact->title = $input['title'];

            $contact->save();

            $bank = new MasterSupplierBank;
            $bank->address = $input['address_bank'];
            $bank->bank_code = $input['bank_code'];
            $bank->city = $input['city'];
            $bank->country = $input['country'];
            $bank->master_supplier_id = $supplier->id;
            $bank->name = $input['name_bank'];
            $bank->remark = $input['remark_bank'];

            $bank->save();

            $banDetail = new MasterSupplierBankDetail;
            $banDetail->supplier_bank_id = $bank->id;
            $banDetail->name = $input['name_bank_detail'];
            $banDetail->acc_no_1 = $input['acc_no_1'];
            $banDetail->acc_no_1_currency = $input['acc_no_1_currency'];
            $banDetail->iban_1 = $input['iban_1'];
            $banDetail->acc_no_2 = $input['acc_no_2'];
            $banDetail->acc_no_2_currency = $input['acc_no_2_currency'];
            $banDetail->iban_2 = $input['iban_2'];
            $banDetail->acc_no_3 = $input['acc_no_3'];
            $banDetail->acc_no_3_currency = $input['acc_no_3_currency'];
            $banDetail->iban_3 = $input['iban_3'];
            $banDetail->acc_no_4 = $input['acc_no_4'];
            $banDetail->acc_no_4_currency = $input['acc_no_4_currency'];
            $banDetail->iban_4 = $input['iban_4'];
            $banDetail->swift = $input['swift_bank_detail'];
            $banDetail->bic = $input['bic'];
            $banDetail->remark = $input['remark_bank_detail'];

            $banDetail->save();

            $crpd = new MasterSupplierBankCrpd;
            $crpd->supplier_bank_id = $bank->id;
            $crpd->name = $input['name_crpd'];
            $crpd->address = $input['address_crpd'];
            $crpd->ac_no = $input['ac_no'];
            $crpd->swift = $input['swift_crpd'];
            $crpd->remark = $input['remark_crpd'];
            $crpd->save();

            
        });

        self::saved(function($supplier) {
            $input = Request::all();
            $input['master_supplier_id'] = $supplier->id;


            $detail = MasterSupplierDetail::where('master_supplier_id', $supplier->id)->first();
            $detail->master_supplier_id = $supplier->id;
            $detail->credit_days = $input['credit_days'];
            $detail->credit_limit = $input['credit_limit'];
            $detail->credit_term_type = $input['credit_term_type'];
            $detail->default_payee = $input['default_payee'];
            $detail->gst_id = $input['gst_id'];
            $detail->gst_registration_no = $input['gst_registration_no'];
            $detail->interface_no = $input['interface_no'];
            $detail->service_provided = $input['service_provided'];
            $detail->trading_currency = $input['trading_currency'];
            $detail->xo_calculated_by = $input['xo_calculated_by'];

            $detail->save();

            $contact = MasterSupplierDetailContact::where('master_supplier_detail_id', $detail->id)->first();
            $contact->email = $input['email'];
            $contact->fax = $input['fax'];
            $contact->given_name = $input['given_name'];
            $contact->master_supplier_detail_id = $detail->id;
            $contact->phone = $input['phone'];
            $contact->surname = $input['surname'];
            $contact->title = $input['title'];

            $contact->save();


            $bank = MasterSupplierBank::where('master_supplier_id', $supplier->id)->first();
            $bank->address = $input['address_bank'];
            $bank->bank_code = $input['bank_code'];
            $bank->city = $input['city'];
            $bank->country = $input['country'];
            $bank->master_supplier_id = $supplier->id;
            $bank->name = $input['name_bank'];
            $bank->remark = $input['remark_bank'];

            $bank->save();

            $banDetail = MasterSupplierBankDetail::where('supplier_bank_id', $bank->id)->first();
            $banDetail->supplier_bank_id = $bank->id;
            $banDetail->name = $input['name_bank_detail'];
            $banDetail->acc_no_1 = $input['acc_no_1'];
            $banDetail->acc_no_1_currency = $input['acc_no_1_currency'];
            $banDetail->iban_1 = $input['iban_1'];
            $banDetail->acc_no_2 = $input['acc_no_2'];
            $banDetail->acc_no_2_currency = $input['acc_no_2_currency'];
            $banDetail->iban_2 = $input['iban_2'];
            $banDetail->acc_no_3 = $input['acc_no_3'];
            $banDetail->acc_no_3_currency = $input['acc_no_3_currency'];
            $banDetail->iban_3 = $input['iban_3'];
            $banDetail->acc_no_4 = $input['acc_no_4'];
            $banDetail->acc_no_4_currency = $input['acc_no_4_currency'];
            $banDetail->iban_4 = $input['iban_4'];
            $banDetail->swift = $input['swift_bank_detail'];
            $banDetail->bic = $input['bic'];
            $banDetail->remark = $input['remark_bank_detail'];

            $banDetail->save();

            $crpd = MasterSupplierBankCrpd::where('supplier_bank_id', $bank->id)->first();
            $crpd->supplier_bank_id = $bank->id;
            $crpd->name = $input['name_crpd'];
            $crpd->address = $input['address_crpd'];
            $crpd->ac_no = $input['ac_no'];
            $crpd->swift = $input['swift_crpd'];
            $crpd->remark = $input['remark_crpd'];
            $crpd->save();
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
