<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RepairController extends Controller
{
    public function index()
    {
        $repairs = DB::table('repairs')
            ->join('vehicle', 'repairs.vehicle_id', '=', 'vehicle.id')
            ->leftJoin('status', 'repairs.status_repairs_id', '=', 'status.id')
            ->where('vehicle.user_id', Auth::id())
            ->select(
                'repairs.*',
                'vehicle.brand',
                'vehicle.model',
                'vehicle.license_plate',
                'status.status as status_name'
            )
            ->orderBy('repairs.id', 'desc')
            ->get();

        $vehicles = DB::table('vehicle')
            ->where('user_id', Auth::id())
            ->get();

        $statuses = DB::table('status')->get();

        return view('repairs.index', compact('repairs', 'vehicles', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicle_id'       => ['required', 'integer'],
            'status_repairs_id'=> ['required', 'integer'],
            'photos_comments'  => ['nullable', 'string'],
        ]);

        DB::table('repairs')->insert([
            'vehicle_id'        => $validated['vehicle_id'],
            'status_repairs_id' => $validated['status_repairs_id'],
            'photos_comments'   => $validated['photos_comments'] ? json_encode(['comment' => $validated['photos_comments']]) : null,
        ]);

        return redirect()->route('repairs.index')->with('success', 'Javítás sikeresen rögzítve!');
    }

    public function destroy($id)
    {
        $repair = DB::table('repairs')
            ->join('vehicle', 'repairs.vehicle_id', '=', 'vehicle.id')
            ->where('repairs.id', $id)
            ->where('vehicle.user_id', Auth::id())
            ->select('repairs.id')
            ->first();

        if ($repair) {
            DB::table('repairs')->where('id', $id)->delete();
        }

        return redirect()->route('repairs.index')->with('success', 'Javítás törölve.');
    }
}