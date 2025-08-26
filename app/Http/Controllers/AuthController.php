<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register (Request $request) {
       $fields =  $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($fields);

        return response()->json(
            [
                'message' => 'User registered successfully',
                'user' => $user
            ], 201
        );
    }

    public function login (Request $request) {
        $request->validate([
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken($user->name);

        return response()->json([
            'message' => 'User logged in successfully',
            'access_token' => $token,
            'user' => $user,
        ],201);
    }

    public function logout (Request $request) {

        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }

    public function changePassword (Request $request) {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Logic to change the password

        return response()->json(['message' => 'Password changed successfully']);
    }
}
