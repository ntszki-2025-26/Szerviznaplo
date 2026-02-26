<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', [LoginController::class, 'login'])
    ->name('login.attempt');

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::view('register', 'register')->name('register');

Route::post('register', [RegisterController::class, 'register'])
    ->name('register.store');
