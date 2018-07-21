<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class CompanyDepartmentRequest extends FormRequest
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
        $code = 'required|unique:company_departments,department_code';
        
        if ($this->method() == 'PATCH') {
            $code = 'required|unique:company_departments,department_code,' . $this->segment(3);
        }

        return [
            'department_name' => 'required',
            'department_code' => 'required',
        ];
    }
}
