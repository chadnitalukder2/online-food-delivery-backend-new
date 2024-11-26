<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthService
{
 

    public function createUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function loginUser(array $data){
        $user = User::where('email', $data['email'])->first();
    
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }

   

}
