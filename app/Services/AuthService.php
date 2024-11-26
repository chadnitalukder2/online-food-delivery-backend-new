<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthService
{
 

    public function createUser(array $data)
    {
        return User::create($data);
    }

  

   

}
