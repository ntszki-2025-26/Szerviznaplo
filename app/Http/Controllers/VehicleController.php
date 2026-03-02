<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
   
    public function index()
    {
        $vehicles = DB::table('vehicle')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('vehicles.index', compact('vehicles'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand'         => ['required', 'string', 'max:50'],
            'model'         => ['required', 'string', 'max:50'],
            'year'          => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
            'vin'           => ['nullable', 'string', 'max:50'],
            'license_plate' => ['required', 'string', 'max:50'],
            'mileage'       => ['required', 'integer', 'min:0'],
        ]);

        DB::table('vehicle')->insert([
            'user_id'       => Auth::id(),
            'brand'         => $validated['brand'],
            'model'         => $validated['model'],
            'year'          => $validated['year'],
            'vin'           => $validated['vin'] ?? null,
            'license_plate' => $validated['license_plate'],
            'mileage'       => $validated['mileage'],
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Jármű sikeresen hozzáadva!');
    }

    
    public function destroy($id)
    {
        DB::table('vehicle')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()->route('vehicles.index')->with('success', 'Jármű törölve.');
    }
}