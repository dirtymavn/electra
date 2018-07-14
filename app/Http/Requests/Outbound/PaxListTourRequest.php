<?php

namespace App\Http\Requests\Outbound;

use Illuminate\Foundation\Http\FormRequest;

class PaxListTourRequest extends FormRequest
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
            'deviation' => 'required',
            'title' => 'required',
            'surname' => 'required',
            'given_name' => 'required',
            'gender' => 'required',
            'id_no' => 'required',
            'ptc' => 'required',
            'dob' => 'required',
        ];
    }
}
