<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'admin')->orWhere('role', 'super_admin')->get();
        return view('admin.admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,super_admin',
            'password' => 'required|string',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);
        return redirect()->route('admin.admin.index')->with('success', "Yaratildi");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.admin.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            "name"       => "sometimes|required|string|max:255",
            'email' => 'sometimes|required|email|unique:users,email',
            'role' => 'sometimes|required|in:admin,super_admin',
            'password' => 'sometimes|required|string',
            "jshshir"    => "sometimes|required|digits:14",
            "passport_id" => ["sometimes", "required", "regex:/^[A-Z]{2}[0-9]{7}$/", "unique:data_users"],
            "phone"      => "sometimes|required|string",
            "province"   => "sometimes|required|string",
            "region"     => "sometimes|required|string",
            "gender"     => "sometimes|required|in:Erkak,Ayol",
        ]);

        $data['password'] = Hash::make($data['password']);


        $user->update([
            'name'   => $data['name'],
            'email' => $data['emial'],
            'password' => $data['password'],
            'role' => $data['role'],
            'gender' => $data['gender'],
        ]);
        $user->data->update([
            "user_id"    => $user->id,
            "jshshir"    => $data['jshshir'],
            "passport_id" => $data['passport_id'],
            "phone"      => $data['phone'],
            "province"   => $data['province'],
            "region"     => $data['region'],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admin.index')->with('success', "O'chirildi");
    }
}
