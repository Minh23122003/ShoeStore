<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:20|unique:users,username',
            'password' => 'required|string|min:8',
            'name' => 'required|string|max:50',
            'email' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|size:10'
        ], [
            'username.required' => 'Please enter the username!',
            'username.max' => 'Username is too long. It cannot be longer than 20 characters!',
            'username.unique' => 'Username already exists!',
            'password.required' => 'Please enter the password',
            'password.min' => 'Password is too short. It cannot be shorter than 8 characters!',
            'name.required' => 'Please enter the name!',
            'name.max' => 'Username is too long. It cannot be longer than 50 characters!',
            'email.required' => 'Please enter the email!',
            'address.required' => 'Please enter the address!',
            'phone.required' => 'Please enter the phone!',
            'phone.size' => 'Phone must have 10 digits!',
        ]);

        $user = new User();
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->is_admin = $request->input('is_admin');
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
            'name' => 'required|string|max:50',
            'email' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string|size:10'
        ], [
            'username.required' => 'Please enter the username!',
            'username.max' => 'Username is too long. It cannot be longer than 20 characters!',
            'username.unique' => 'Username already exists!',
            'password.min' => 'Password is too short. It cannot be shorter than 8 characters!',
            'name.required' => 'Please enter the name!',
            'name.max' => 'Username is too long. It cannot be longer than 50 characters!',
            'email.required' => 'Please enter the email!',
            'address.required' => 'Please enter the address!',
            'phone.required' => 'Please enter the phone!',
            'phone.size' => 'Phone must have 10 digits!',
        ]);

        $user1 = User::find($user->id);
        $user1->username = $request->input('username');
        if ($request->filled('password')) {
            $user1->password = Hash::make($request->input('password'));
        }
        $user1->name = $request->input('name');
        $user1->email = $request->input('email');
        $user1->address = $request->input('address');
        $user1->phone = $request->input('phone');
        $user1->is_admin = $request->input('is_admin');
        $user1->save();

        return redirect()->route('admin.users.index')->with('success', 'User changed successfully.'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
