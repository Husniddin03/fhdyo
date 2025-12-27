<?php

namespace App\Http\Controllers;

use App\Models\Couple;
use Illuminate\Http\Request;

class QuizController extends Controller
{

    public function index()
    {
        return view('quiz.index');
    }
    public function check(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:20',
        ]);

        $human = Couple::where('husband_key', $request->key)->orWhere('wife_key', $request->key)->first();

        return redirect()->route('quiz.start')->with('success', 'Kalitingiz qabul qilindi, testni boshlang');
    }
    public function start()
    {
        return view('quiz.start');
    }

    public function answers(Request $request)
    {
        return response('success');
    }

    public function quiz($key)
    {
        return view('quiz.quiz')->with('success', 'Test boshlandi');
    }
}
