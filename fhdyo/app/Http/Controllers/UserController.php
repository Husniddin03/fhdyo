<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users =  User::with('userData','couples')->get();
        return view('user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string',
        ]);

        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function show(User $user)
    {
        return $user->load('userData','couples');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
            'role' => 'nullable|string',
        ]);

        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message'=>'User deleted']);
    }
}
