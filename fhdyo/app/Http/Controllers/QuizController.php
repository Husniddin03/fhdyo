<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class QuizController extends Controller
{

    public function index()
    {
        return view('quiz.index');
    }
    public function check(Request $request)
    {
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
