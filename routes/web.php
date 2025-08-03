<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::get('/', function () {
    return view('dashboard.index');
})->name('dashboard.index')->middleware('auth');
