<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'first_name' => $request->input('first_name'), 
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

    }

    public function login(request $request)
    {
        if (!Auth::attempt($request->only('username', 'password')))
        return response([
            'message' => 'Invalid login credentials'
        ], status: response::HTTP_UNAUTHORIZED);

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24);

        return response()->json([
            'message' => 'success',
            'access_token' => $token, // Return the token here
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
    
        $tokenId = $user->currentAccessToken()->id;
        $tokenRevoked = $user->tokens()->where('id', $tokenId)->delete();
    
        if ($tokenRevoked) {
            return response()->json(['message' => 'Successfully logged out']);
        } else {
            return response()->json(['message' => 'You are not logged out :('], 400); // 400 Bad Request
        }
    }

    public function user()
    {
        return Auth::user();
    }
}
