<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\CoupleController;
use App\Http\Controllers\Controller;
use App\Models\Couple;
use App\Models\Question;
use App\Models\User;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function status()
    {
        $couple = Couple::find(session('couples_id'));

        if (count($couple->firstUser->answers) > 0 && count($couple->secondUser->answers) > 0) {

            $data = [];
            $all = ['first' => 0, 'second' => 0, 'all' => 0];
            for ($i = 0; $i < count($couple->firstUser->answers); $i++) {
                $data[$i]['question'] = $couple->firstUser->answers[$i]->question->question;
                $data[$i]['first'] = $couple->firstUser->answers[$i]->answer;
                $data[$i]['second'] = $couple->secondUser->answers[$i]->answer;
                $data[$i]['check'] = $couple->firstUser->answers[$i]->answer == $couple->secondUser->answers[$i]->answer;
                $all['all'] += $couple->firstUser->answers[$i]->answer == $couple->secondUser->answers[$i]->answer ? 1 : 0;
                $all['first'] += $couple->firstUser->answers[$i]->answer;
                $all['second'] += $couple->secondUser->answers[$i]->answer;
            }
            $all['all'] = round($all['all'] * 100 / count($couple->firstUser->answers), 2);

            $couple->update([
                'result'=>$all['all']
            ]);

            return view('user.status', compact('couple', 'data', 'all'));
        }else{
            return view('user.status');
        }
    }

    public function quiz($key)
    {

        $data = Couple::where('key', $key)->first();

        $number = session('number');
        $types = explode(',', $data->questions_type);

        $questions = collect();

        foreach ($types as $type) {
            $questions = $questions->merge(
                Question::where('type', $type)
                    ->inRandomOrder()
                    ->limit($number)
                    ->get()
            );
        }

        $questions = $questions->all();
        shuffle($questions);

        $user = User::find(session('user_id'));
        return view('user.quiz', compact('questions', 'user'));
    }

    public function checkKey(Request $request)
    {
        $request->validate([
            'key' => 'required|exists:couples,key',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $data = Couple::where('key', $request->key)->first();

        if (!$request->user_id) {
            return back()->with([
                'data' => $data,
                'key'  => $request->key,
            ]);
        }
        session(['user_id' => $request->user_id]);
        session(['number' => $data->number]);
        session(['couples_id' => $data->id]);
        return redirect()->route('user.quiz', $data->key);
    }

    public function result_() {
        $couple = Couple::find(session('couples_id'));
        $contr = new CoupleController;
        $data = $contr->resultData($couple); 
        return view('user.result_', compact('couple', 'data'));
    }

    public function result(Request $request)
    {
        $answers = json_decode($request->answers);
        foreach ($answers as $answer) {
            UserAnswer::create([
                'couples_id' => session('couples_id'),
                'user_id' => $request->user_id,
                'questions_id' => $answer->id,
                'answer' => $answer->answer,
            ]);
        }
        return redirect()->route('user.result_');
    }

    public function download(Request $request) {
        return true;
    }
}
