<?php

namespace App\Http\Requests\MasterData\Accounting;

use Illuminate\Foundation\Http\FormRequest;

class BudgetRateRequest extends FormRequest
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
            'acc_period_mo' => 'required',
            'from_currency' => 'required',
            'to_currency' => 'required',
            'exchange_rate' => 'required|numeric',
        ];
    }
}
