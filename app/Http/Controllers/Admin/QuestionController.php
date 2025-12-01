<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::select('type')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('type')
            ->get();
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => "required|unique:questions,type",
            'questions' => "required|array",
            'questions.*' => "required|string",
        ]);

        foreach ($request->input('questions') as $question) {
            if ($question != null) {
                Question::create([
                    'type' => $request->input('type'),
                    'question' => $question
                ]);
            }
        }
        return redirect()->route('admin.questions.show', $request->input('type'))->with('success', "$request->input('type') toifasi yaratildi");
    }


    public function show(string $type)
    {
        $questions = Question::where('type', $type)->get();
        return view('admin.questions.show', compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $type)
    {
        $questions = Question::where('type', $type)->get();

        return view('admin.questions.edit', compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $type)
    {
        $request->validate([
            'type' => "required|unique:questions,type",
            'questions' => "required|array",
            'questions.*' => "required|string",
        ]);

        Question::where('type', $type)->delete();

        foreach ($request->input('questions') as $question) {
            if ($question != null) {
                Question::create([
                    'type' => $request->input('type'),
                    'question' => $question
                ]);
            }
        }
        return redirect()->route('admin.questions.show', $request->input('type'))->with('seccess', "Muoffaqiyatli yangilandi");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question) {
        $question->delete();
        return back()->with('success', "O'chirildi");
    }

    public function delete_all(Request $request)
    {
        $type = $request->input('type');
        Question::where('type', $type)->delete();
        return redirect()->route('admin.questions.index', $type)->with('seccess', "Muoffaqiyatli o'chirildi");
    }
}
