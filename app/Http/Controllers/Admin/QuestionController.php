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
        $create = request('create') ?? 'false';
        $update = request('update') ?? null;
        $questions = Question::select('type')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('type')
            ->get();
        return view('admin.questions.index', compact('questions', 'create', 'update'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'type' => "required|unique:questions,type"
        ]);
        $type = $request->input('type');
        $count = $request->input('count');
        return view('admin.questions.create', compact('type', 'count'));
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
            Question::create([
                'type' => $request->input('type'),
                'question' => $question
            ]);
        }
        return redirect()->route('admin.questions.show', $request->input('type'))->with('success', "$request->input('type') toifasi yaratildi");
    }

    /**
     * Display the specified resource.
     */
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
    public function update(Request $request, string $id)
    {
        if (is_numeric($id)) {
        } else {
            Question::where('type', $id)->update(['type' => $request->input('type')]);
        }
        return redirect()->route('admin.questions.show', $id)->with('seccess', "Muoffaqiyatli yangilandi");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
