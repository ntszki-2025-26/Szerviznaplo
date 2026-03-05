<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FaultController extends Controller
{

    public function index()
    {

        $faults = DB::table('faults')
            ->join('vehicle', 'faults.vehicle_id', '=', 'vehicle.id')
            ->where('vehicle.user_id', Auth::id())
            ->select('faults.*', 'vehicle.brand', 'vehicle.model', 'vehicle.license_plate')
            ->orderBy('faults.id', 'desc')
            ->get();

        $vehicles = DB::table('vehicle')
            ->where('user_id', Auth::id())
            ->get();

        return view('faults.index', compact('faults', 'vehicles'));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'vehicle_id' => ['required', 'integer'],
            'description' => ['required', 'string', 'max:50'],
            'category' => ['required', 'string', 'max:50'],
            'estimated_time' => ['nullable', 'string', 'max:50'],
        ]);
        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/uploads/faults'), $filename);
        $photoPath = 'uploads/faults/' . $filename;



        $qrCode = 'FAULT-' . strtoupper(uniqid());

        DB::table('faults')->insert([
            'vehicle_id' => $validated['vehicle_id'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'estimated_time' => $validated['estimated_time'] ?? null,
            'photo' => $photoPath,
            'qr_code' => $qrCode,
        ]);

        return redirect()->route('faults.index')->with('success', 'Hiba sikeresen rögzítve!');
    }


    public function destroy($id)
    {

        $fault = DB::table('faults')
            ->join('vehicle', 'faults.vehicle_id', '=', 'vehicle.id')
            ->where('faults.id', $id)
            ->where('vehicle.user_id', Auth::id())
            ->select('faults.*')
            ->first();

        if ($fault) {
            if ($fault->photo) {
                Storage::disk('public')->delete($fault->photo);
            }
            DB::table('faults')->where('id', $id)->delete();
        }

        return redirect()->route('faults.index')->with('success', 'Hiba törölve.');
    }
}