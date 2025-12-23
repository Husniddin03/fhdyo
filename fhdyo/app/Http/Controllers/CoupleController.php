<?php

namespace App\Http\Controllers;

use App\Models\Couple;
use Illuminate\Http\Request;

class CoupleController extends Controller
{
    public function index()
    {
        return Couple::with(['husbandData','wifeData','user','answers','results'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'husband'=>'required|integer|exists:humans,id',
            'wife'=>'required|integer|exists:humans,id',
            'husband_key'=>'nullable|string',
            'wife_key'=>'nullable|string',
            'status'=>'nullable|string',
            'user_id'=>'required|integer|exists:users,id',
        ]);

        return Couple::create($data);
    }

    public function show(Couple $couple)
    {
        return $couple->load(['husbandData','wifeData','user','answers','results']);
    }

    public function update(Request $request, Couple $couple)
    {
        $data = $request->validate([
            'husband'=>'integer|exists:humans,id',
            'wife'=>'integer|exists:humans,id',
            'husband_key'=>'nullable|string',
            'wife_key'=>'nullable|string',
            'status'=>'nullable|string',
            'user_id'=>'integer|exists:users,id',
        ]);

        $couple->update($data);
        return $couple;
    }

    public function destroy(Couple $couple)
    {
        $couple->delete();
        return response()->json(['message'=>'Couple deleted']);
    }
}
