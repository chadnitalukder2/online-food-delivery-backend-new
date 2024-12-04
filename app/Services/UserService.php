<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUsers()
    {
        $query = User::query();
        return $query->orderBy('id', 'desc')->get();
       
    }
    public function getUserById($id){
        return User::findOrFail($id);

    }

    public function updatedUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    // Delete a menu
    public function deleteUser(User $user)
    {
        $user->delete();
    }


}
