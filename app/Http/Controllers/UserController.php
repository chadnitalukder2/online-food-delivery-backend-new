<?php

namespace App\Http\Controllers;

use App\Collections\UsersCollection;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthRegisterResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $UserService;

    public function __construct()
    {
        $this->UserService = new UserService();
    }

    public function index(Request $request)
    {
        $users = $this->UserService->getUsers();
        return new UsersCollection($users);
    }
    
    public function show($id){
        $users = $this->UserService->getUserById($id);
        return new AuthRegisterResource($users);
    }

    public function update(AuthRegisterRequest $request, $id)
    {
      
        $users = $this->UserService->getUserById($id);
        $updatedUsers = $this->UserService->updatedUser($users, $request->validated());
        return new AuthRegisterResource($updatedUsers);
    }

    // Delete 
    public function destroy($id)
    {
        $users = $this->UserService->getUserById($id);
        $this->UserService->deleteUser($users);
        return response()->json(null, 204);
    }

}
