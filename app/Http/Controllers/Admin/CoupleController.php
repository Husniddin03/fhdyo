<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Couple;
use App\Models\Question;
use App\Models\User;
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
            ->whereNotNull('questions_id')
            ->get();
        return view('admin.couple.index', compact('users', 'couples'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $questions = Question::all('type');
        return view('admin.couple.create', compact('users', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_user_id'=>'required|exists:user,id',
            'second_user_id'=>'required|exists:user,id',
            'questions_id'=>'required|exists:questions,id'
        ]);

        $couple = Couple::where([
            'first_user_id'=>$request->input('first_user_id'),
            'second_user_id'=>$request->input('second_user_id'),
            'questions_id'=>$request->input('questions_id')
        ])->first();

        if($couple){
            $couple->update($request->all());
        }else{
            Couple::create($request->all());
        }

        $key = (string) Str::uuid();

        return redirect()->route('')->with("seccess", "Juftik yaratildi");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
