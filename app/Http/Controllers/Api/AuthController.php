<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {

        $validatedData = $request->validated();
        $validatedData['unhashed_password'] =  $validatedData['password'];
        $validatedData['password'] = Hash::make( $validatedData['password']);

        $user = User::create($validatedData);
        $token = $user->createToken('token')->plainTextToken;
        return new LoginResource([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        // check user base on email
        $user = User::where('email', $validatedData['email'])->first();

        // Message for wrong email
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Email Tidak Sesuai'],
            ]);
        }

        // Message for wrong password
        if (!Hash::check($validatedData['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password Tidak Sesuai'],
            ]);
        }

        // Hapus token lama dan generate token baru
        $user->tokens()->delete();
        $token = $user->createToken('token')->plainTextToken;

        // Return response
        return new LoginResource([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        //delete all token related to the current user
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'LogOut Success'
        ]);
    }
}
