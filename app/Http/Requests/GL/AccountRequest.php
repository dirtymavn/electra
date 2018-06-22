<?php

namespace App\Http\Requests\GL;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'acc_no_key' => 'required',
            'acc_no_interface' => 'required',
            'acc_description' => 'required',
            'sub_acc_id' => 'required',
            'acc_type' => 'required',
            'rollup_key_acc_no' => 'required',
            'acc_liquidity' => 'required',
            'rollup_detail' => 'required',
            'analysis_type' => 'required'
        ];
    }
}
