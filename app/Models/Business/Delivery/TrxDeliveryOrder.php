<?php

namespace App\Models\Business\Delivery;

use Illuminate\Database\Eloquent\Model;

use Request;

class TrxDeliveryOrder extends Model
{
    protected $table = 'trx_delivery_orders';

    protected $fillable = [
    	'do_no',
    	'do_type_id',
    	'do_date',
    	'team_code',
    	'sender',
    	'tel_no',
    	'department_code',
    	'is_draft',
    	'company_id'
    ];

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function trx_customer()
    {
        return $this->hasOne( TrxDeliveryOrderCustomer::class );
    }

    /**
     * { function_description }
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function trx_dispatch()
    {
        return $this->hasOne( TrxDeliveryOrderDespatch::class );
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::created(function ($delivery) {
            $input = Request::all();
            $input['delivery_id'] = $delivery->id;

            $customer = new TrxDeliveryOrderCustomer();
            $customer->trx_delivery_order_id = $delivery->id;
            $customer->customer_no = $input['customer_no'];
            $customer->customer_address = $input['customer_address'];
            $customer->tel_no = $input['tel_no'];
            $customer->attn = $input['attn'];
            $customer->save();

            // dd($delivery->id);

            $despatch = new TrxDeliveryOrderDespatch();
            $despatch->trx_delivery_order_id = $delivery->id;
            $despatch->despatch_staff = $input['despatch_staff'];
            $despatch->despatch_time = $input['despatch_time'];
            $despatch->instruction = $input['instruction'];
            $despatch->related_so = $input['related_so'];
            $despatch->to_area = $input['to_area'];
            $despatch->to_delivery = $input['to_delivery'];
            $despatch->to_collect = $input['to_collect'];
            $despatch->received_by = $input['received_by'];
            $despatch->date_received = $input['date_received'];
            $despatch->save();

        });

        self::saved(function ($delivery) {
            $input = Request::all();
            $input['delivery_id'] = $delivery->id;
            $customer = TrxDeliveryOrderCustomer::where('trx_delivery_order_id', $delivery->id)->first();
            $customer->trx_delivery_order_id = $delivery->id;
            $customer->customer_no = $input['customer_no'];
            $customer->customer_address = $input['customer_address'];
            $customer->tel_no = $input['tel_no'];
            $customer->attn = $input['attn'];
            $customer->save();

            // dd($delivery->id);

            $despatch = TrxDeliveryOrderDespatch::where('trx_delivery_order_id', $delivery->id)->first();
            $despatch->trx_delivery_order_id = $delivery->id;
            $despatch->despatch_staff = $input['despatch_staff'];
            $despatch->despatch_time = $input['despatch_time'];
            $despatch->instruction = $input['instruction'];
            $despatch->related_so = $input['related_so'];
            $despatch->to_area = $input['to_area'];
            $despatch->to_delivery = $input['to_delivery'];
            $despatch->to_collect = $input['to_collect'];
            $despatch->received_by = $input['received_by'];
            $despatch->date_received = $input['date_received'];
            $despatch->save();
        });
    }

    public static function getAutoNumber()
    {
        $result = self::orderBy('id', 'desc')->first();

        $findCode = \DB::table('setting_codes')->whereType('DO')->first();
        if ($result) {
            $lastNumber = (int) substr($result->do_no, strlen($result->do_no) - 4, 4);
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

            $currMonth = (int)date('m', strtotime($result->do_no));
            $currYear = (int)date('y', strtotime($result->do_no));
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
