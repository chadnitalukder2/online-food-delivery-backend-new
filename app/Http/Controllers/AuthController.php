<?php

namespace App\Http\Controllers;

use App\Collections\AuthCollection;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use GuzzleHttp\Psr7\Request;

class AuthController extends Controller
{
    protected $AuthService;

    public function __construct()
    {
        $this->AuthService = new AuthService();
    }


    public function register(AuthRequest $request)
    {
       
        $user = $this->AuthService->createUser($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
            'user' => new AuthResource($user),
            'token' => $token,
        ]);

    }
}
