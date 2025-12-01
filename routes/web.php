<?php

use App\Http\Controllers\Admin\CoupleController;
use App\Http\Controllers\Admin\PageConreoller;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminCotroller;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\User\QuizController;
use Illuminate\Support\Facades\Route;
// admin routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', [PageConreoller::class, 'index']);
    Route::get('admin/index', [PageConreoller::class, 'index'])->name('admin.index');
    Route::resource('admin/users', UserController::class, array('as' => 'admin'));

    Route::get('admin/couple/process', [CoupleController::class, 'process'])->name('admin.couple.process');
    Route::get('admin/couple/getkey/{key}', [CoupleController::class, 'getkey'])->name('admin.couple.getkey');
    Route::resource('admin/couple', CoupleController::class, array('as' => 'admin'));
    Route::post('admin/questions/delete_all', [QuestionController::class, 'delete_all'])->name('admin.questions.delete_all');
    Route::resource('admin/questions', QuestionController::class, array('as' => 'admin'));
    Route::resource('admin/admin', AdminCotroller::class, array('as' => 'admin'));
    Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
Route::get('error', [PageConreoller::class, 'error'])->name('error');

Route::get('admin/enter', [LoginController::class, 'enter'])->name('admin.enter');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');


// user routes
Route::get('/', [QuizController::class, 'login']);
Route::get('user/login', [QuizController::class, 'login'])->name('user.login');
Route::get('user/quiz/{name}', [QuizController::class, 'quiz'])->name('user.quiz');
Route::post('user/checkKey', [QuizController::class, 'checkKey'])->name('user.checkKey');
Route::post('user/result', [QuizController::class, 'result'])->name('user.result');
Route::post('user/download', [QuizController::class, 'download'])->name('user.download');
Route::get('user/status', [QuizController::class, 'status'])->name('user.status');
Route::get('user/result_', [QuizController::class, 'result_'])->name('user.result_');
