<?php

namespace App\Models\Business\Delivery;

use Illuminate\Database\Eloquent\Model;
use App\Models\Setting\CoreForm;
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
        $formCode = CoreForm::getCodeBySlug('delivery');

        $findBranch = Branch::findMyBranch();
        $branchCode = '';

        if ($findBranch) {
            $branchCode = $findBranch->branch_code;
        }


        $result = self::selectRaw('right(do_no,4) as do_no')
            ->whereRaw('left(right(do_no,8),4)=to_char(now(),\'mmyy\')')
            ->orderByRaw('right(do_no, 4) desc')
            ->where('do_no', '<>', 'draft')
            ->whereCompanyId(user_info('company_id'))
            ->first();

        $nextNumber = '0001';
        if ($result) {
            $nextNumber = str_pad((intval($result->do_no) + 1), 4, '0', STR_PAD_LEFT);
        }

        $formatedNumber = $formCode . $branchCode . date('my') . $nextNumber;
        return $formatedNumber;
    }
}
