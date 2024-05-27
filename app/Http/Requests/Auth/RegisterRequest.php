<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => 'required|string|max:25|unique:users,user_name,NULL,id,domain,NULL,guid,NULL',
            'password' => 'required|string',
        ];
    }
}
