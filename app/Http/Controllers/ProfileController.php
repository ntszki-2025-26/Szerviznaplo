<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'username.required'  => 'A felhasználónév megadása kötelező.',
            'username.unique'    => 'Ez a felhasználónév már foglalt.',
            'password.min'       => 'A jelszónak legalább 8 karakter hosszúnak kell lennie.',
            'password.confirmed' => 'A két jelszó nem egyezik meg.',
        ]);

        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        /** @var User $user */
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil sikeresen frissítve!');
    }
}