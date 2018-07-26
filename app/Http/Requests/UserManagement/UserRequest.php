<?php

namespace App\Http\Requests\UserManagement;

use Illuminate\Foundation\Http\FormRequest;
use Request;
class UserRequest extends FormRequest
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
        $userName = 'required|max:20|unique:users,username';
        $email = 'required|email|unique:users,email';
        
        if ($this->method() == 'PATCH') {
            $userName = 'required|max:20|unique:users,username,' . $this->segment(3);
            $email = 'required|email|unique:users,email,' . $this->segment(3);
        }

        return [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'username' => $userName,
            'email' => $email,
            'password' => 'required_if:is_required,==,requirred|min:8',
            'conf_password' => 'required_if:is_required,==,requirred|min:8|same:password',
            'company_id' => Request::segment(3) != 1 ? 'required' : '',
            'role_id' => 'required',
            'branch_id' => 'required_if:company_role,==,admin',
            'company_department_id' => 'required_if:company_role,==,admin',
        ];
    }

    public function messages()
    {
        return [
            'password.required_if' => 'The password field is required.',
            'conf_password.required_if' => 'The confirmation password field is required.',
            'branch_id.required_if' => 'The branch id field is required.',
            'company_department_id.required_if' => 'The department id field is required.',
        ];
    }
}
