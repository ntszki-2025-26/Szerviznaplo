<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FaultController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

// Bejelentkezést igénylő oldalak
Route::middleware('auth')->group(function () {

    Route::get('dashboard', function () {
        $userId = Auth::id();

        // Járművek száma
        $vehicleCount = DB::table('vehicle')->where('user_id', $userId)->count();

        // Aktív hibák száma (a felhasználó járműveihez tartozó)
        $faultCount = DB::table('faults')
            ->join('vehicle', 'faults.vehicle_id', '=', 'vehicle.id')
            ->where('vehicle.user_id', $userId)
            ->count();

        // Következő időpont
        $nextAppointment = DB::table('appointments')
            ->where('user_id', $userId)
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date', 'asc')
            ->value('appointment_date');

        $nextAppointmentFormatted = $nextAppointment
            ? \Carbon\Carbon::parse($nextAppointment)->format('m. d.')
            : null;

        return view('dashboard', compact('vehicleCount', 'faultCount', 'nextAppointmentFormatted'));
    })->name('dashboard');

    // Járművek
    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    // Hibák
    Route::get('faults', [FaultController::class, 'index'])->name('faults.index');
    Route::post('faults', [FaultController::class, 'store'])->name('faults.store');
    Route::delete('faults/{id}', [FaultController::class, 'destroy'])->name('faults.destroy');

    // Időpontok
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

});