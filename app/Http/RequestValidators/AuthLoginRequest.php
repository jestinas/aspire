<?php


namespace App\Http\RequestValidators;

class AuthLoginRequest extends Request
{
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:254',
            'password' => 'required|min:6|max:18',
            'remember_me' => ''
        ];
    }
}
