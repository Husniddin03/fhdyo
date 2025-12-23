<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        return Question::with('category','answers')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id'=>'required|integer|exists:categories,id',
            'question'=>'required|string',
        ]);

        return Question::create($data);
    }

    public function show(Question $question)
    {
        return $question->load('category','answers');
    }

    public function update(Request $request, Question $question)
    {
        $data = $request->validate([
            'category_id'=>'integer|exists:categories,id',
            'question'=>'string',
        ]);

        $question->update($data);
        return $question;
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return response()->json(['message'=>'Question deleted']);
    }
}
