<?php

namespace App\Http\Controllers;

use App\Models\Human;
use Illuminate\Http\Request;

class HumanController extends Controller
{
    public function index()
    {
        return Human::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'=>'required|string',
            'middle_name'=>'nullable|string',
            'last_name'=>'required|string',
            'gender'=>'nullable|string',
            'birthday'=>'nullable|date',
            'phone'=>'nullable|string',
            'jshshir'=>'nullable|string',
            'passport_id'=>'nullable|string',
            'province'=>'nullable|string',
            'region'=>'nullable|string',
        ]);

        return Human::create($data);
    }

    public function show(Human $human)
    {
        return $human;
    }

    public function update(Request $request, Human $human)
    {
        $data = $request->validate([
            'first_name'=>'string',
            'middle_name'=>'nullable|string',
            'last_name'=>'string',
            'gender'=>'nullable|string',
            'birthday'=>'nullable|date',
            'phone'=>'nullable|string',
            'jshshir'=>'nullable|string',
            'passport_id'=>'nullable|string',
            'province'=>'nullable|string',
            'region'=>'nullable|string',
        ]);

        $human->update($data);
        return $human;
    }

    public function destroy(Human $human)
    {
        $human->delete();
        return response()->json(['message'=>'Human deleted']);
    }
}
