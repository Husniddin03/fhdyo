<?php

namespace App\Http\Controllers;

use App\Models\CoupleAnswer;
use Illuminate\Http\Request;

class CoupleAnswerController extends Controller
{
    public function index()
    {
        return CoupleAnswer::with('couple','question')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'couple_id'=>'required|integer|exists:couples,id',
            'key'=>'nullable|string',
            'question_id'=>'required|integer|exists:questions,id',
            'answer'=>'required|integer|in:-1,0,1',
        ]);

        return CoupleAnswer::create($data);
    }

    public function show(CoupleAnswer $coupleAnswer)
    {
        return $coupleAnswer->load('couple','question');
    }

    public function update(Request $request, CoupleAnswer $coupleAnswer)
    {
        $data = $request->validate([
            'couple_id'=>'integer|exists:couples,id',
            'key'=>'nullable|string',
            'question_id'=>'integer|exists:questions,id',
            'answer'=>'integer|in:-1,0,1',
        ]);

        $coupleAnswer->update($data);
        return $coupleAnswer;
    }

    public function destroy(CoupleAnswer $coupleAnswer)
    {
        $coupleAnswer->delete();
        return response()->json(['message'=>'Answer deleted']);
    }
}
