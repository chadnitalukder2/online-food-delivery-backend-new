<?php

namespace App\Http\Controllers;

use App\Collections\AuthCollection;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\AuthRegisterResource;
use App\Services\AuthService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class AuthRegisterController extends Controller
{
    protected $AuthService;

    public function __construct()
    {
        $this->AuthService = new AuthService();
    }


    public function register(AuthRegisterRequest $request)
    {
    
        $user = $this->AuthService->createUser($request->validated());
     
        $token = $user->createToken('auth_token')->plainTextToken;
        Auth::login($user);
        return response()->json([
            'user' => new AuthRegisterResource($user),
            'token' => $token,
            'token_type' => 'Bearer',
        ]);

    }

  
}
