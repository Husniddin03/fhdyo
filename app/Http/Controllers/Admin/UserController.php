<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Couple;
use App\Models\DataUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->with('data')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        $data = $request->validate([
            "name"       => "required|string|max:255",
            "jshshir"    => "required|digits:14",
            "passport_id" => ["required", "regex:/^[A-Z]{2}[0-9]{7}$/", "unique:data_users"],
            "phone"      => "required|string",
            "province"   => "required|string",
            "region"     => "required|string",
            "gender"     => "required|in:Erkak,Ayol",
        ]);


        $user = User::create([
            'name'   => $data['name'],
            'gender' => $data['gender'],
        ]);
        DataUser::create([
            "user_id"    => $user->id,
            "jshshir"    => $data['jshshir'],
            "passport_id" => $data['passport_id'],
            "phone"      => $data['phone'],
            "province"   => $data['province'],
            "region"     => $data['region'],
        ]);

        return redirect()->route('admin.users.show', $user)->with('success', $data['name'] . " muvoffaqiyatli yaratildi");
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('data')->find($id);
        $couples = Couple::where('first_user_id', $id)
            ->orWhere('second_user_id', $id)
            ->get();

        return view('admin.users.show', compact('user', 'couples'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('data')->find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $data = $request->validate([
            "name"       => "sometimes|required|string|max:255",
            "jshshir"    => "sometimes|required|digits:14",
            "passport_id" => ["sometimes", "required", "regex:/^[A-Z]{2}[0-9]{7}$/"],
            "phone"      => "sometimes|required|string",
            "province"   => "sometimes|required|string",
            "region"     => "sometimes|required|string",
            "gender"     => "sometimes|required|in:Erkak,Ayol",
        ]);


        $user->update([
            'name'   => $data['name'],
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

        return redirect()->route('admin.users.show', $user)->with('success', $data['name'] . " muvoffaqiyatli yaratildi");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', "Foydalanuvchi malumot o'chirildi");   
    }
}
