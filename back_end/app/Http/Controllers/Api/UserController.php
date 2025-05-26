<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:20|unique:users,username',
            'email' => 'required|string|unique:users,email',
        ], [
            'username.unique' => 'Username already exists!',
            'email.unique' => 'Email already exists!',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->is_admin = false;
        $user->save();

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (! $user || ! Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'Username or password is wrong!'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function profile(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out!']);
    }

}
