<?php

namespace App\Http\Controllers;

use App\Models\Couple;

class GraphicController extends Controller
{
    public function graphic()
    {
        $married = Couple::where('status', 'married')->with('husbandData')->get();
        $divorced = Couple::where('status', 'divorced')->with('husbandData')->get();

        // Group by month for married couples
        $marriedByMonth = $married->groupBy(function ($couple) {
            return \Carbon\Carbon::parse($couple->date)->format('Y-m');
        })->map(function ($group) {
            return $group->count();
        })->sortKeys();

        // Group by month for divorced couples
        $divorcedByMonth = $divorced->groupBy(function ($couple) {
            return \Carbon\Carbon::parse($couple->date)->format('Y-m');
        })->map(function ($group) {
            return $group->count();
        })->sortKeys();

        // Get all months to ensure both datasets have same structure
        $allMonths = $marriedByMonth->keys()->merge($divorcedByMonth->keys())->unique()->sort()->values();

        // Prepare data for chart
        $labels = $allMonths->map(function ($month) {
            return \Carbon\Carbon::parse($month)->format('M Y');
        })->toArray();

        $marriedData = $allMonths->map(function ($month) use ($marriedByMonth) {
            return $marriedByMonth->get($month, 0);
        })->toArray();

        $divorcedData = $allMonths->map(function ($month) use ($divorcedByMonth) {
            return $divorcedByMonth->get($month, 0);
        })->toArray();

        // Calculate percentage change (example for 2021 vs 2020)
        $total2021 = $married->filter(function ($couple) {
            return \Carbon\Carbon::parse($couple->date)->year == 2021;
        })->count();

        $total2020 = $married->filter(function ($couple) {
            return \Carbon\Carbon::parse($couple->date)->year == 2020;
        })->count();

        $percentageChange = $total2020 > 0 ? round((($total2021 - $total2020) / $total2020) * 100) : 0;

        return view('graphic.graphic', compact('labels', 'marriedData', 'divorcedData', 'percentageChange'));
    }
}
