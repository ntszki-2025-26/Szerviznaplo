<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FaultController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicelogController;
use App\Http\Controllers\AdminController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {

    Route::get('dashboard', function () {
        $userId = Auth::id();

        $vehicleCount = DB::table('vehicle')->where('user_id', $userId)->count();

        $faultCount = DB::table('faults')
            ->join('vehicle', 'faults.vehicle_id', '=', 'vehicle.id')
            ->where('vehicle.user_id', $userId)
            ->count();

        $nextAppointment = DB::table('appointments')
            ->where('user_id', $userId)
            ->where('appointment_date', '>=', now()->toDateString())
            ->orderBy('appointment_date', 'asc')
            ->value('appointment_date');

        $nextAppointmentFormatted = $nextAppointment
            ? \Carbon\Carbon::parse($nextAppointment)->format('m. d.')
            : null;

        $pendingRepairs = DB::table('repairs')
            ->join('vehicle', 'repairs.vehicle_id', '=', 'vehicle.id')
            ->join('status', 'repairs.status_repairs_id', '=', 'status.id')
            ->where('vehicle.user_id', $userId)
            ->whereIn('status.status', ['Függőben', 'Folyamatban'])
            ->select('vehicle.brand', 'vehicle.model')
            ->get();

        $pendingRepairCount = $pendingRepairs->count();
        $pendingRepairNames = $pendingRepairs->map(fn($r) => $r->brand . ' ' . $r->model)->join(', ');

        return view('dashboard', compact('vehicleCount', 'faultCount', 'nextAppointmentFormatted', 'pendingRepairCount', 'pendingRepairNames'));
    })->name('dashboard');

    Route::get('servicelog', [ServicelogController::class, 'index'])->name('servicelog.index');

    Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    Route::get('faults', [FaultController::class, 'index'])->name('faults.index');
    Route::post('faults', [FaultController::class, 'store'])->name('faults.store');
    Route::delete('faults/{id}', [FaultController::class, 'destroy'])->name('faults.destroy');

    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::delete('appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    Route::get('repairs', [RepairController::class, 'index'])->name('repairs.index');
    Route::post('repairs', [RepairController::class, 'store'])->name('repairs.store');
    Route::delete('repairs/{id}', [RepairController::class, 'destroy'])->name('repairs.destroy');

    Route::prefix('mechanic')->middleware('mechanic')->group(function () {
        Route::get('dashboard', [MechanicController::class, 'dashboard'])->name('mechanic.dashboard');
        Route::get('repairs', [MechanicController::class, 'repairs'])->name('mechanic.repairs');
        Route::post('repairs', [MechanicController::class, 'storeRepair'])->name('mechanic.repairs.store');
        Route::post('repairs/{id}/status', [MechanicController::class, 'updateStatus'])->name('mechanic.repairs.status');
        Route::get('faults', [MechanicController::class, 'faults'])->name('mechanic.faults');
        Route::get('appointments', [MechanicController::class, 'appointments'])->name('mechanic.appointments');
        Route::post('appointments/{id}/status', [MechanicController::class, 'updateAppointmentStatus'])->name('mechanic.appointments.status');
    });

    Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.role');
    });
    Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.role');
    });
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

});