<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class CoreConfigRequest extends FormRequest
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
            'base_date' => 'required',
            'decimal_number' => 'required',
            'allow_backdate' => 'required',
            'backdate_interval' => 'required',
        ];
    }
}
