<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|alpha_num|min:3|max:32',
            'email' => 'Required|Between:3,255|Email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'A title is required',
        ];
    }
}
