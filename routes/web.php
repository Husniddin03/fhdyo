<?php

use App\Http\Controllers\admin\PageConreoller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/index', [PageConreoller::class, 'index'])->name('admin.index');
Route::get('admin/users/index', [PageConreoller::class, 'users'])->name('admin.users.index');
