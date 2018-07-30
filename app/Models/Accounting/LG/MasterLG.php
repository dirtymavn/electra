<?php

namespace App\Models\Accounting\LG;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MasterLG extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'master_lg';

    protected $fillable = [
    	'lg_no',
        'lg_type',
        'lg_date',
        'delivery_status',
        'supplier_ref_no',
        'supplier_id',
        'credit_term_id',
        'remark',
        'footer',
        'tour_voucher',
        'paid_amt',
        'base_currency_id',
        'base_amt',
        'bill_currency_id',
        'bill_amt',
        'lg_status',
        'company_id',
        'branch_id',
        'is_draft',
    ];

    /**
     * Get the detail for the LG.
     */
    public function details()
    {
        return $this->hasMany(MasterLGDetail::class, 'master_lg_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function($lg) {
            $lgDetails = \DB::table('temporaries')->whereType('data-lg')
                ->whereUserId(user_info('id'))
                ->get();
            if (count($lgDetails) > 0) {
                foreach ($lgDetails as $lgDetail) {
                    $detail = new MasterLGDetail;

                    $lgDetail = json_decode($lgDetail->data);

                    $detail->master_lg_id = $lg->id;
		            $detail->product_code = $lgDetail->product_code;
		            $detail->product_code_description = $lgDetail->product_code_description;
		            $detail->qty = $lgDetail->qty;
		            $detail->unit_cost = $lgDetail->unit_cost;
		            $detail->total_amt = $lgDetail->total_amt;
		            $detail->discount = $lgDetail->discount;
		            $detail->tax = $lgDetail->tax;
		            $detail->gst_amt = $lgDetail->gst_amt;
                    
                    $detail->save();
                }
            }

        });
    }

    public static function getAutoNumber()
    {
        $result = self::orderBy('id', 'desc')->first();

        $findCode = \DB::table('setting_codes')->whereType('LG')->first();
        if ($result) {
            $lastNumber = (int) substr($result->lg_no, strlen($result->lg_no) - 4, 4);
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

            $currMonth = (int)date('m', strtotime($result->lg_no));
            $currYear = (int)date('y', strtotime($result->lg_no));
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
}
