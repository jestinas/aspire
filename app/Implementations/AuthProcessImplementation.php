<?php


namespace App\Implementations;


use App\Interfaces\AuthProcessImplementationInterface;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthProcessImplementation implements AuthProcessImplementationInterface
{
    public function __construct()
    {

    }

    /**
     * Create the user
     */
    public function create_user(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
