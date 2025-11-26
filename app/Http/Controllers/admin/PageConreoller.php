<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PageConreoller extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function users() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
