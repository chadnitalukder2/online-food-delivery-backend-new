<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\AuthLoginResource;
use App\Services\AuthService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
  
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->validated();
       
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'user' => new AuthLoginResource($user),
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }
}
