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
        $couples = Couple::whereNotNull('first_user_id')
            ->whereNotNull('second_user_id')
            ->get();
        return view('admin.couple.index', compact('couples'));
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
            'questions_type' => 'required|exists:questions,type'
        ]);

        $couple = Couple::where([
            'first_user_id' => $request->input('first_user_id'),
            'second_user_id' => $request->input('second_user_id'),
            'questions_type' => $request->input('questions_type'),
        ])->first();

        $key = (string) Str::uuid();
        if ($couple) {
            $couple->update([
                'first_user_id' => $request->input('first_user_id'),
                'second_user_id' => $request->input('second_user_id'),
                'questions_type' => $request->input('questions_type'),
                'result' => null,
                'key' => $key
            ]);
        } else {
            Couple::create([
                'first_user_id' => $request->input('first_user_id'),
                'second_user_id' => $request->input('second_user_id'),
                'questions_type' => $request->input('questions_type'),
                'result' => null,
                'key' => $key
            ]);
        }


        return redirect()->route('admin.couple.getkey', ['key' => $key])->with("seccess", "Juftik yaratildi, kalit orqali testni boshlang");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $couple = Couple::find($id);

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

        return view('admin.couple.show', compact('couple', 'data', 'all'));
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
}
