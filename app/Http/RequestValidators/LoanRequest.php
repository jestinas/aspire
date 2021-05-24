<?php


namespace App\Http\RequestValidators;


class LoanRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => 'required|max:50',
            'city' => 'required|max:30',
            'pan' => 'required|regex:/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/',
            'amount' => 'required|integer|min:100|max:10000000',
            'tenure' => 'required|integer|min:4|max:150'
        ];
    }
}
