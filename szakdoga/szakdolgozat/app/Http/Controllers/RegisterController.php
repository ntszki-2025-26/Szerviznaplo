<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'username'   => ['required', 'string', 'max:255', 'unique:users'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'  => ['required', 'string', 'max:50'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'username'   => $validatedData['username'],
            'email'      => $validatedData['email'],
            'first_name' => $validatedData['first_name'],
            'last_name'  => $validatedData['last_name'],
            'password' => Hash::make($validatedData['password']),        ]);

        Auth::login($user);

        return redirect()->intended(route('dashboard'));
    }
}