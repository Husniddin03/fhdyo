<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Couple;
use App\Models\User;
use Illuminate\Http\Request;

class PageConreoller extends Controller
{
    public function index()
    {
        $users = User::all();
        $couples = Couple::whereNotNull('first_user_id')
            ->whereNotNull('second_user_id')
            ->whereNotNull('questions_id')
            ->get();
        return view('admin.index', compact('users', 'couples'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
