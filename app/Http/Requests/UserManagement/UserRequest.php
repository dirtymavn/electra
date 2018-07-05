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
        $userName = 'required|unique:users,username';
        $email = 'required|email|unique:users,email';
        
        if ($this->method() == 'PATCH') {
            $userName = 'required|unique:users,username,' . $this->segment(3);
            $email = 'required|email|unique:users,email,' . $this->segment(3);
        }

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => $userName,
            'email' => $email,
            'password' => 'required_if:is_required,==,requirred|min:8',
            'conf_password' => 'required_if:is_required,==,requirred|min:8|same:password',
            'company_id' => Request::segment(3) != 1 ? 'required' : '',
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'password.required_if' => 'The password field is required.',
            'conf_password.required_if' => 'The confirmation password field is required.',
        ];
    }
}
