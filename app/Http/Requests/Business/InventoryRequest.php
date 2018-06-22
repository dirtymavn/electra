<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_no' => 'required',
            'sales_date' => 'required',
            'ticket_amt' => 'required',
            'rebate' => 'required',
            'inventory_type' => 'required',
            'voucher_no' => 'required',
            'product_code' => 'required',
            'recevied_date' => 'required',
            'booked_qty' => 'required',
            'sold_qty' => 'required'
        ];
    }
}
