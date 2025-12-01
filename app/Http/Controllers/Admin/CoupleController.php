<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Couple;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CoupleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $couples = Couple::whereNotNull('result')
            ->get();

        $thiw = $this;

        return view('admin.couple.index', compact('couples', 'thiw'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $questions = Question::select('type')->distinct()->get();
        return view('admin.couple.create', compact('users', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_user_id' => 'required|exists:users,id',
            'second_user_id' => 'required|exists:users,id',
            'number' => 'required'
        ]);

        $types = Question::select('type')->distinct()->pluck('type')->implode(',');

        $key = (string) Str::uuid();
        Couple::create([
            'first_user_id' => $request->first_user_id,
            'second_user_id' => $request->second_user_id,
            'questions_type' => $types,
            'result' => null,
            'key' => $key,
            'number' => $request->number,
        ]);


        return redirect()->route('admin.couple.getkey', ['key' => $key])->with("success", "Juftik yaratildi, kalit orqali testni boshlang");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $couple = Couple::find($id);


        $all = ['first' => 0, 'second' => 0, 'all' => 0];
        $data1 = [];
        for ($i = 0; $i < count($couple->firstUser->answers); $i++) {
            $data1[$i]['question'] = $couple->firstUser->answers[$i]->question->question;
            $data1[$i]['first'] = $couple->firstUser->answers[$i]->answer;
            $data1[$i]['second'] = $couple->secondUser->answers[$i]->answer;
            $data1[$i]['check'] = $couple->firstUser->answers[$i]->answer == $couple->secondUser->answers[$i]->answer;
            $all['all'] += $couple->firstUser->answers[$i]->answer == $couple->secondUser->answers[$i]->answer ? 1 : 0;
            $all['first'] += $couple->firstUser->answers[$i]->answer;
            $all['second'] += $couple->secondUser->answers[$i]->answer;
        }
        $all['all'] = round($all['all'] * 100 / count($couple->firstUser->answers), 2);

        $data = $this->resultData($couple);

        return view('admin.couple.show', compact('couple', 'data', 'data1', 'all'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Couple $couple)
    {
        $couple->delete();
        return redirect()->route('admin.couple.index')->with('success', "Malumot o'chirildi");
    }

    public function process()
    {
        $users = User::all();
        $couples = Couple::whereNull('result')
            ->get();
        return view('admin.couple.process', compact('couples'));
    }

    public function getkey($key)
    {
        return view('admin.couple.getkey', compact('key'));
    }

    public function resultData($couple)
    {
        $firstAnswers = $couple->firstUser->answers->keyBy('questions_id');
        $secondAnswers = $couple->secondUser->answers->keyBy('questions_id');
        $types = explode(',', $couple->questions_type);
        $questions = Question::all();

        $result = $firstAnswers->map(function ($answer1, $questionId) use ($secondAnswers) {
            $answer2 = $secondAnswers->get($questionId);

            return [
                'question_id' => $questionId,
                'first_answer' => $answer1->answer,
                'second_answer' => $answer2?->answer,
                'is_equal' => $answer1->answer === ($answer2?->answer),
            ];
        });
        $data = [];

        foreach ($types as $type) {
            $data[$type] = 0;
        }

        foreach ($result as $item) {
            $data[$questions->find($item['question_id'])->type] += $item['is_equal'] ? 1 : 0;
        }

        foreach ($types as $type) {
            $data[$type] = $data[$type] * 100 / $couple->number;
        }

        return $data;
    }
}
