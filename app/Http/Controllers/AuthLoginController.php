<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Resources\AuthLoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    // Handle login
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->validated();

        // Attempt to authenticate user with provided credentials
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'The email or password you entered is incorrect. Please try again.'
            ], 401);
        }

        // Retrieve authenticated user
        $user = Auth::user();

        // Generate a new token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => new AuthLoginResource($user),
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    // Handle logout
    public function logout(Request $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if user is authenticated
        // if (!$user) {
        //     return response()->json(['error' => 'User not authenticated'], 401);
        // }

        // Revoke the user's current token
        // $user->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
