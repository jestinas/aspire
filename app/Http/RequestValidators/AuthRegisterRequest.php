<?php


namespace App\Http\RequestValidators;


class AuthRegisterRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:20',
            'email' => 'required|email|max:254|unique:users',
            'password' => 'required|min:6|max:18|confirmed'
        ];
    }
}
