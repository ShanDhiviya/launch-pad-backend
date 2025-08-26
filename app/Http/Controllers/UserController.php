<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;

class UserController extends Controller
{

    public function index()
    {
        if (Auth::user()->isRole('admin')) {
            return UserResource::collection(User::all()->load('role'));
        }

        return response()->json([
            "message" => "Access denied"
        ], 403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

          if(Auth::user()->isRole('admin')){
                $fields = $request->validated();
                $user = User::create($fields);

            return response()->json([
                "message" => "User created successfully",
                "user" => $user
            ], 201);
       }
         return response()->json([
            "message" => "Access denied"
        ], 403);
    }


    public function show(User $user)
    {
       if(Auth::user()->isRole('admin')){
          return new UserResource($user->load('role'));
       }

        return Auth::id() === $user->id ? new UserResource($user) : response()->json([
            "message" => "Access denied"
        ], 403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

         $user = User::findOrFail($id);

       $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'role_id' => 'sometimes|required|exists:roles,id',
        ]);

        if(Auth::user()->isRole('admin')){

            $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? $request->password : $user->password,
            'role_id' => $request->role_id ?? $user->role_id,
        ]);

            return response()->json([
                "message" => "User updated successfully",
                "user" => $user->load('role')
            ]);
        }

        return response()->json([
            "message" => "Access denied"
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
