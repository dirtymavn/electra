<?php

namespace App\Http\Requests\Auth;

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
        $userName = 'required|unique:users,username';
        $email = 'required|email|unique:users,email';

        if ($this->method() == 'PATCH') {
            $userName = 'required|unique:users,username,' . user_info('id');
            $email = 'required|email|unique:users,email,' . user_info('id');
        }

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => $userName,
            'email' => $email,
            'password' => 'min:8',
            'conf_password' => 'min:8|same:password',
            'avatar' => 'image|max:2000'
        ];

    }
}
