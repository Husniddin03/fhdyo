<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function enter()
    {
        return view('admin.enter');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        Auth::logout();

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.index')->with('success', "Tizimga kirdingiz");
        }

        return back()->with('error', "Email yoki parol xato");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.enter')->with('success', "Tizimdan chiqdingiz");
    }
}
