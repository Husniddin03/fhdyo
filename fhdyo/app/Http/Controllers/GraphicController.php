<?php

namespace App\Http\Controllers;

use App\Models\Couple;

class GraphicController extends Controller
{
    public function graphic()
    {
        $provinces = [
            "Toshkent sh",
            "Toshkent",
            "Samarqand",
            "Buxoro",
            "Farg'ona",
            "Andijon",
            "Sirdaryo",
            "Jizzax",
            "Qashqadaryo",
            "Surxondaryo",
            "Navoiy",
            "Xorazm",
            "Qoraqalpog'iston R"
        ];

        $months = ['Yan', 'Fev', 'Mar', 'Apr', 'May', 'Iyun', 'Iyul', 'Avg', 'Sen', 'Okt', 'Noy', 'Dek'];

        $provinceData = [];

        foreach ($provinces as $province) {
            $monthlyData = [];

            foreach ($months as $index => $month) {
                $monthNumber = $index + 1;

                // Nikohlanganlar soni
                $married = Couple::where('status', 'married')
                    ->whereHas('husbandData', function ($query) use ($province) {
                        $query->where('province', $province);
                    })
                    ->whereMonth('date', $monthNumber)
                    ->whereYear('date', date('Y'))
                    ->count();

                // Ajrashganlar soni
                $divorced = Couple::where('status', 'divorced')
                    ->whereHas('husbandData', function ($query) use ($province) {
                        $query->where('province', $province);
                    })
                    ->whereMonth('date', $monthNumber)
                    ->whereYear('date', date('Y'))
                    ->count();

                $monthlyData[] = [
                    'month' => $month,
                    'married' => $married,
                    'divorced' => $divorced
                ];
            }

            $provinceKey = strtolower(str_replace([' ', "'"], '', $province));
            $provinceData[$provinceKey] = $monthlyData;
        }

        return view('graphic.graphic', compact('provinceData'));
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
