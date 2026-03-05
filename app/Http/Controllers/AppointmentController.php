<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = DB::table('appointments')
            ->join('vehicle', 'appointments.vehicle_id', '=', 'vehicle.id')
            ->leftJoin('status', 'appointments.status_appointments_id', '=', 'status.id')
            ->where('appointments.user_id', Auth::id())
            ->select(
                'appointments.*',
                'vehicle.brand',
                'vehicle.model',
                'vehicle.license_plate',
                'status.status as status_name'
            )
            ->orderBy('appointments.appointment_date', 'desc')
            ->get();

        $vehicles = DB::table('vehicle')
            ->where('user_id', Auth::id())
            ->get();

        $statuses = DB::table('status')->get();

        return view('appointments.index', compact('appointments', 'vehicles', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id'       => ['required', 'integer'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        DB::table('appointments')->insert([
            'user_id'                  => Auth::id(),
            'vehicle_id'               => $validated['vehicle_id'],
            'appointment_date'         => $validated['appointment_date'],
            'status_appointments_id'   => 1, // alapértelmezett: "Függőben"
        ]);

        return redirect()->route('appointments.index')->with('success', 'Időpont sikeresen foglalva!');
    }

    public function destroy($id)
    {
        DB::table('appointments')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('appointments.index')->with('success', 'Időpont törölve.');
    }
}