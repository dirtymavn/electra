<?php

namespace App\Http\Requests\Internal;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'staff_no' => 'required',
            'staff_fullname' => 'required',
            'status' => 'required',
            'type' => 'required',
            'title' => 'required',
            'home_tel' => 'required',
            'mobile' => 'required',
            'employment_date' => 'required'
        ];
    }
}
