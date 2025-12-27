<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Couple;
use App\Models\CoupleAnswer;
use App\Models\CoupleQuiz;
use App\Models\CoupleResult;
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

        $couple = Couple::where('husband_key', $request->key)->orWhere('wife_key', $request->key)->first();
        if ($couple) {
            session()->put('key', $request->key);
            return redirect()->route('quiz.start')->with('success', 'Kalitingiz qabul qilindi, testni boshlang');
        }
        return redirect()->route('quiz.index')->with('error', 'Kalitingiz qabul qilinmadi, qayta kiriting');
    }
    public function start()
    {
        $key = session('key');
        $couple = Couple::where('husband_key', $key)->orWhere('wife_key', $key)->first();

        // Agar shu key bilan javob berilgan bo‘lsa
        foreach ($couple->answers as $answer) {
            if ($answer->key == $key) {
                $answer = 'Siz avval javeb bergansiz';
                return view('quiz.result', compact('answer'));
            }
        }
        return view('quiz.start', compact('key'))->with('success', "Testni boshlang");
    }

    public function answers(Request $request)
    {
        $key = session('key');
        $couple = Couple::where('husband_key', $key)->orWhere('wife_key', $key)->first();

        if (!$couple) {
            return redirect()->route('quiz.answer')->with('success', "Siznin kalitingiz muddati tugagan");
        }

        // Validate request
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer|exists:questions,id',
            'answers.*.answer' => 'required|integer|in:-1,0,1'
        ]);

        // Save all answers
        foreach ($validated['answers'] as $answerData) {
            CoupleAnswer::create([
                'couple_id' => $couple->id,
                'key' => $key,
                'question_id' => $answerData['question_id'],
                'answer' => $answerData['answer']
            ]);
        }

        // === NATIJA HISOBLASH ===
        $husbandKey = $couple->husband_key;
        $wifeKey    = $couple->wife_key;

        $categories = Category::all();
        $totalPercent = 0;
        $categoryCount = $categories->count();

        foreach ($categories as $category) {
            $questionIds = $category->questions->pluck('id');

            $husbandAnswers = CoupleAnswer::where('couple_id', $couple->id)
                ->where('key', $husbandKey)
                ->whereIn('question_id', $questionIds)
                ->pluck('answer', 'question_id');

            $wifeAnswers = CoupleAnswer::where('couple_id', $couple->id)
                ->where('key', $wifeKey)
                ->whereIn('question_id', $questionIds)
                ->pluck('answer', 'question_id');

            $matched = 0;
            $total   = count($questionIds);

            foreach ($questionIds as $qid) {
                if (isset($husbandAnswers[$qid]) && isset($wifeAnswers[$qid])) {
                    if ($husbandAnswers[$qid] == $wifeAnswers[$qid]) {
                        $matched++;
                    }
                }
            }

            $percent = $total > 0 ? ($matched / $total) * 100 : 0;

            // couple_results jadvaliga yozish
            CoupleResult::updateOrCreate(
                [
                    'couple_id'   => $couple->id,
                    'category_id' => $category->id,
                ],
                [
                    'percent' => $percent,
                ]
            );

            $totalPercent += $percent;
        }

        // Umumiy natija (o‘rtacha foiz)
        $overall = $categoryCount > 0 ? $totalPercent / $categoryCount : 0;
        $couple->result = $overall;
        $couple->save();

        return redirect()->route('quiz.result')->with('success', "Test yakunlandi va natijalar hisoblandi");
    }


    public function result()
    {
        $answer = 'Test yakunlandi';
        return view('quiz.result', compact('answer'));
    }


    public function quiz($key)
    {
        $quizes = Couple::where('husband_key', $key)
            ->orWhere('wife_key', $key)
            ->first()
            ->quizes
            ->map(fn($q) => [
                'question_id' => $q->question->id,
                'question' => $q->question->question
            ])
            ->values()
            ->toArray();
        return view('quiz.quiz', compact('quizes'))->with('success', 'Test boshlandi');
    }
}
