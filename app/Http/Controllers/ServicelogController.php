<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServicelogController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $vehicles = DB::table('vehicle')
            ->where('user_id', $userId)
            ->get();

        $repairs = DB::table('repairs')
            ->join('vehicle', 'repairs.vehicle_id', '=', 'vehicle.id')
            ->join('status', 'repairs.status_repairs_id', '=', 'status.id')
            ->where('vehicle.user_id', $userId)
            ->select(
                'repairs.*',
                'vehicle.brand',
                'vehicle.model',
                'vehicle.license_plate',
                'vehicle.mileage',
                'status.status as status_name'
            )
            ->orderByDesc('repairs.id')
            ->get();

        $appointments = DB::table('appointments')
            ->join('vehicle', 'appointments.vehicle_id', '=', 'vehicle.id')
            ->join('status', 'appointments.status_appointments_id', '=', 'status.id')
            ->where('appointments.user_id', $userId)
            ->select(
                'appointments.*',
                'vehicle.brand',
                'vehicle.model',
                'vehicle.license_plate',
                'status.status as status_name'
            )
            ->orderByDesc('appointments.appointment_date')
            ->get();

        $faults = DB::table('faults')
            ->join('vehicle', 'faults.vehicle_id', '=', 'vehicle.id')
            ->where('vehicle.user_id', $userId)
            ->select('faults.*', 'vehicle.brand', 'vehicle.model', 'vehicle.license_plate')
            ->orderByDesc('faults.id')
            ->get();

        return view('servicelog.index', compact('vehicles', 'repairs', 'appointments', 'faults'));
    }
}