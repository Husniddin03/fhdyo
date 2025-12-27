<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/home', [GraphicController::class, 'home'])->name('home');

    Route::get('graphic', [GraphicController::class, 'graphic'])->name('graphic');

    Route::resources([
        'users' => UserController::class,
        'couples' => CoupleController::class,
        'humans' => HumanController::class,
        'categories' => CategoryController::class,
        'questions' => QuestionController::class,
    ]);
});

Route::get('/', [QuizController::class, 'index'])->name('quiz.index');
Route::get('quiz/result', [QuizController::class, 'result'])->name('quiz.result');
Route::post('quiz/check', [QuizController::class, 'check'])->name('quiz.check');
Route::get('quiz/start', [QuizController::class, 'start'])->name('quiz.start');
Route::post('quiz/answers', [QuizController::class, 'answers'])->name('quiz.answers');
Route::get('quiz/quiz/{key}', [QuizController::class, 'quiz'])->name('quiz.quiz');

Route::post('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('admin', function () {
    return view('login');
})->name('admin');

Route::post('login', function (Request $request) {
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string',
    ]);

    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);
        return redirect()->route('home')->with('success', 'You entered successfully');
    }

    return redirect()->route('admin')->with('error', 'Email or password invalid');
})->name('login');
