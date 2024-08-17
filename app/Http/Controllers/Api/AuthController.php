<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            //delete old token and generate new one
            $user->tokens()->delete();
            $token = $user->createToken('token')->plainTextToken;

            //return response
            return new LoginResource([
                'token' => $token,
                'user' => $user,
            ]);
        } else {
            return response()->json([
                'message' => 'Login Failed'
            ], 401);
        }
    }

    public function logout(Request $request) {
        //delete all token related to the current user
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'LogOut Success'
        ]);
    }
}
