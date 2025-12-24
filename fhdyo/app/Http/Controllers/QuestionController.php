<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionController extends Controller
{
    public function destroy($id)
    {
        if($id == -1) {
            $ids = request()->input('questions', []);
            Question::whereIn('id', $ids)->delete();
            return redirect()->route('questions.index')->with('success', 'Selected questions deleted successfully');
        }
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('categories.index')->with('success', 'Question deleted successfully');
    }
}
