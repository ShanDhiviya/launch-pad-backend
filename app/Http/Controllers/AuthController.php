<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{

    public function register (Request $request) {
       $fields =  $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($fields);
        $token = $user->createToken($request->email);

        return response()->json(
            [
                'user' => $user,
                'token' => $token,
            ]
        );
    }

    public function login (Request $request) {
        $request->validate([
            'email' => 'required|string|email|exists:users',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken($request->email);

        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token,
            'user' => $user,
        ],201);
    }

    public function profile(Request $request) {

        $user = new UserResource($request->user()->load('role'));
        return response()->json([
            'user' => $user,
        ]);
    }

    public function logout (Request $request) {

        $request->user()->tokens()->delete();
        return response()->json(['message' => 'User logged out successfully']);
    }
}
