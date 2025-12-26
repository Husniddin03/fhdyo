<?php

namespace App\Http\Controllers;

use App\Models\Couple;

class GraphicController extends Controller
{
    public function graphic()
    {
        $month = [
            "Toshkent sh",
            "Toshkent",
            "Samarqand",
            "Buxoro",
            "Fargona",
            "Andijon",
            "Sirdaryo",
            "Jizzax",
            "Qashqadaryo",
            "Surxandaryo",
            "Navoiy",
            "Buxoro",
            "Xorazm",
            "Qoraqalpog'stoon R"
        ];
        return view('graphic.graphic', compact(''));
    }


    public function home()
    {
        $married = Couple::where('status', 'married')->with('husbandData')->get();
        $divorced = Couple::where('status', 'divorced')->with('husbandData')->get();

        $provinces = collect($married)->pluck('husbandData.province')
            ->merge(collect($divorced)->pluck('husbandData.province'))
            ->unique()
            ->values();

        $marriedCounts = $provinces->mapWithKeys(function ($province) use ($married) {
            return [$province => $married->filter(fn($c) => $c->husbandData->province === $province)->count()];
        });

        $divorcedCounts = $provinces->mapWithKeys(function ($province) use ($divorced) {
            return [$province => $divorced->filter(fn($c) => $c->husbandData->province === $province)->count()];
        });

        return view('home', [
            'provinces' => $provinces,
            'marriedCounts' => $marriedCounts,
            'divorcedCounts' => $divorcedCounts,
        ]);
    }
}
