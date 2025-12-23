<?php

namespace App\Http\Controllers;

use App\Models\Human;
use Illuminate\Http\Request;

class HumanController extends Controller
{
    public function index()
    {
        $perPage = request()->get('per_page', 13);
        $query = Human::query();

        // 🔍 Qidiruvlar
        if ($fullName = request('full_name')) {
            $query->where('first_name', 'like', "%{$fullName}%")->orWhere('middle_name', 'like', "%{$fullName}%")->orWhere('last_name', 'like', "%{$fullName}%");
        }

        if ($gender = request('gender')) {
            $query->where('gender', $gender);
        }

        if ($birthday = request('birthday')) {
            $query->where('birthday', 'like', "%{$birthday}%");
        }

        if ($phone = request('phone')) {
            $query->where('phone', 'like', "%{$phone}%");
        }

        if ($jshshir = request('jshshir')) {
            $query->where('jshshir', 'like', "%{$jshshir}%");
        }

        if ($passportId = request('passport_id')) {
            $query->where('passport_id', 'like', "%{$passportId}%");
        }

        if ($address = request('address')) {
            $query->where('province', 'like', "%{$address}%")->orWhere('region', 'like', "%{$address}%");
        }

        // 🔽 Sortlashlar
        $sortFields = [
            'first_name' => request('full_name_sort'),
            'gender' => request('gender_sort'),
            'birthday' => request('birthday_sort'),
            'phone' => request('phone_sort'),
            'jshshir' => request('jshshir_sort'),
            'passport_id' => request('passport_id_sort'),
            'province' => request('address_sort'),
        ];

        foreach ($sortFields as $field => $direction) {
            if ($direction) {
                $query->orderBy($field, $direction);
                break; // faqat birinchi sortni qo‘llash
            }
        }


        // 🔢 Paginate
        $count = $query->count();
        $humans = $query->paginate($perPage);

        // ❌ Agar page > lastPage bo‘lsa, oxirgi sahifaga redirect
        if (request()->get('page') > $humans->lastPage()) {
            return redirect()->route('humans.index', [
                'page' => $humans->lastPage(),
                'per_page' => $perPage
            ] + request()->except(['page']));
        }

        return view('human.index', compact('humans', 'count'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string',
            'jshshir' => 'nullable|string',
            'passport_id' => 'nullable|string',
            'province' => 'nullable|string',
            'region' => 'nullable|string',
        ]);

        return redirect()->route('humans.index')->with('success', 'Human created successfully');
    }

    public function show(Human $human)
    {
        return $human;
    }

    public function edit(Human $human)
    {
        return view('human.edit', compact('human'));
    }

    public function update(Request $request, Human $human)
    {
        $data = $request->validate([
            'first_name' => 'string',
            'middle_name' => 'nullable|string',
            'last_name' => 'string',
            'gender' => 'nullable|string',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string',
            'jshshir' => 'nullable|string',
            'passport_id' => 'nullable|string',
            'province' => 'nullable|string',
            'region' => 'nullable|string',
        ]);

        $human->update($data);
        return redirect()->route('humans.index')->with('success', 'Human updated successfully');
    }

    public function destroy($id)
    {
        if($id == -1) {
            $ids = request()->input('humans', []);
            Human::whereIn('id', $ids)->delete();
            return redirect()->route('humans.index')->with('success', 'Selected humans deleted successfully');
        }
        $human = Human::findOrFail($id);
        $human->delete();
        return redirect()->route('humans.index')->with('success', 'Human deleted successfully');
    }
}
