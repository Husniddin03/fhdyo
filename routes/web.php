<?php

use App\Http\Controllers\Admin\CoupleController;
use App\Http\Controllers\Admin\PageConreoller;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
// admin routes
Route::get('/', [PageConreoller::class, 'index']);
Route::get('admin/index', [PageConreoller::class, 'index'])->name('admin.index');
Route::resource('admin/users', UserController::class, array('as'=>'admin'));
Route::resource('admin/couple', CoupleController::class, array('as'=>'admin'));


// user routes
