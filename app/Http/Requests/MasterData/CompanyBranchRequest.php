<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class CompanyBranchRequest extends FormRequest
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
        $code = 'required|unique:company_branchs,branch_code';
        
        if ($this->method() == 'PATCH') {
            $code = 'required|unique:company_branchs,branch_code,' . $this->segment(3);
        }

        return [
            'branch_name' => 'required',
            'branch_code' => 'required',
            'branch_address' => 'required',
            'branch_phone' => 'required',
        ];
    }
}
