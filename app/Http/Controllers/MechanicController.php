<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MechanicController extends Controller
{
    public function dashboard()
    {
        $totalRepairs    = DB::table('repairs')->count();
        $pendingRepairs  = DB::table('repairs')->join('status', 'repairs.status_repairs_id', '=', 'status.id')->where('status.status', 'Függőben')->count();
        $ongoingRepairs  = DB::table('repairs')->join('status', 'repairs.status_repairs_id', '=', 'status.id')->where('status.status', 'Folyamatban')->count();
        $doneRepairs     = DB::table('repairs')->join('status', 'repairs.status_repairs_id', '=', 'status.id')->where('status.status', 'Elvégezve')->count();

        $recentRepairs = DB::table('repairs')
            ->join('vehicle', 'repairs.vehicle_id', '=', 'vehicle.id')
            ->join('users', 'vehicle.user_id', '=', 'users.id')
            ->leftJoin('status', 'repairs.status_repairs_id', '=', 'status.id')
            ->select('repairs.*', 'vehicle.brand', 'vehicle.model', 'vehicle.license_plate', 'users.username', 'status.status as status_name')
            ->orderBy('repairs.id', 'desc')
            ->limit(5)
            ->get();

        return view('mechanic.dashboard', compact('totalRepairs', 'pendingRepairs', 'ongoingRepairs', 'doneRepairs', 'recentRepairs'));
    }

    public function repairs()
    {
        $repairs = DB::table('repairs')
            ->join('vehicle', 'repairs.vehicle_id', '=', 'vehicle.id')
            ->join('users', 'vehicle.user_id', '=', 'users.id')
            ->leftJoin('status', 'repairs.status_repairs_id', '=', 'status.id')
            ->select('repairs.*', 'vehicle.brand', 'vehicle.model', 'vehicle.license_plate', 'users.username', 'status.status as status_name')
            ->orderBy('repairs.id', 'desc')
            ->get();

        $statuses = DB::table('status')->get();
        $vehicles = DB::table('vehicle')
            ->join('users', 'vehicle.user_id', '=', 'users.id')
            ->select('vehicle.*', 'users.username')
            ->get();

        return view('mechanic.repairs', compact('repairs', 'statuses', 'vehicles'));
    }

    public function storeRepair(Request $request)
    {
        $request->validate([
            'vehicle_id'        => ['required', 'integer'],
            'status_repairs_id' => ['required', 'integer'],
            'comment'           => ['nullable', 'string', 'max:500'],
        ]);

        DB::table('repairs')->insert([
            'vehicle_id'        => $request->vehicle_id,
            'status_repairs_id' => $request->status_repairs_id,
            'photos_comments'   => $request->comment ? json_encode(['comment' => $request->comment]) : null,
        ]);

        return redirect()->route('mechanic.repairs')->with('success', 'Javítás sikeresen létrehozva!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_repairs_id' => ['required', 'integer'],
            'comment'           => ['nullable', 'string', 'max:500'],
        ]);

        $repair = DB::table('repairs')->where('id', $id)->first();

        $existingData = $repair->photos_comments ? json_decode($repair->photos_comments, true) : [];
        if ($request->comment) {
            $existingData['comment'] = $request->comment;
        }

        DB::table('repairs')->where('id', $id)->update([
            'status_repairs_id' => $request->status_repairs_id,
            'photos_comments'   => !empty($existingData) ? json_encode($existingData) : null,
        ]);

        return redirect()->route('mechanic.repairs')->with('success', 'Státusz sikeresen frissítve!');
    }

    public function faults()
    {
        $faults = DB::table('faults')
            ->join('vehicle', 'faults.vehicle_id', '=', 'vehicle.id')
            ->join('users', 'vehicle.user_id', '=', 'users.id')
            ->select('faults.*', 'vehicle.brand', 'vehicle.model', 'vehicle.license_plate', 'users.username')
            ->orderBy('faults.id', 'desc')
            ->get();

        return view('mechanic.faults', compact('faults'));
    }

    public function appointments()
    {
        $appointments = DB::table('appointments')
            ->join('vehicle', 'appointments.vehicle_id', '=', 'vehicle.id')
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->leftJoin('status', 'appointments.status_appointments_id', '=', 'status.id')
            ->select('appointments.*', 'vehicle.brand', 'vehicle.model', 'vehicle.license_plate', 'users.username', 'status.status as status_name')
            ->orderBy('appointments.appointment_date', 'asc')
            ->get();

        $statuses = DB::table('status')->get();

        return view('mechanic.appointments', compact('appointments', 'statuses'));
    }

    public function updateAppointmentStatus(Request $request, $id)
    {
        $request->validate([
            'status_appointments_id' => ['required', 'integer'],
        ]);

        DB::table('appointments')->where('id', $id)->update([
            'status_appointments_id' => $request->status_appointments_id,
        ]);

        return redirect()->route('mechanic.appointments')->with('success', 'Időpont státusza frissítve!');
    }
}