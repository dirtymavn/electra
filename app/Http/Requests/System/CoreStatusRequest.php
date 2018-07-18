<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class CoreStatusRequest extends FormRequest
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
            'status_name' => 'required',
            'status_code' => 'required',
            'status_order' => 'required',
            'status_approval_flag' => 'required'
        ];
    }
}
