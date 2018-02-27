<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3|max:32',
            'email' => 'required|email',
            'password' => 'min:0',
            'confirm_password' => 'min:0|same:password',
        ];
    }
}
