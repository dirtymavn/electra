<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class VoucherRequest extends FormRequest
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
            'voucher_no' => 'required',
            'voucher_status' => 'required',
            'voucher_date' => 'required|date',
            'voucher_currency' => 'required',
            'voucher_amt' => 'required',
            'valid_from' => 'required',
            'valid_to' => 'required'
        ];
    }
}
