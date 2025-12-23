<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::resources([
    'users' => UserController::class,
    'couples' => CoupleController::class,
    'humans' => HumanController::class,
    'categories' => CategoryController::class,
    'questions' => QuestionController::class,
]);