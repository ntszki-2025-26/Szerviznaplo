<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FaultController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::post('login', [LoginController::class, 'login'])
    ->name('login.attempt');

Route::post('logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::view('register', 'register')->name('register');
Route::post('register', [RegisterController::class, 'register'])
    ->name('register.store');


Route::middleware('auth')->group(function () {

    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    
    Route::get('faults', [FaultController::class, 'index'])->name('faults.index');
    Route::post('faults', [FaultController::class, 'store'])->name('faults.store');
    Route::delete('faults/{id}', [FaultController::class, 'destroy'])->name('faults.destroy');

});