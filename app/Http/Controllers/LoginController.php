<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    private const MECHANIC_EMAIL    = 'szerelo1@gmail.com';
    private const MECHANIC_PASSWORD = 'mechanic123';

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials['email'] = strtolower($credentials['email']);
        if ($credentials['email'] === self::MECHANIC_EMAIL) {
            if ($credentials['password'] !== self::MECHANIC_PASSWORD) {
                return back()->withErrors([
                    'email' => 'Érvénytelen szerelői belépési adatok.',
                ])->onlyInput('email');
            }
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;

            if ($role == "2") {
                return redirect()->intended('admin/dashboard');
            }

            if ($role == "1") {
                return redirect()->intended('mechanic/dashboard');
            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Hibás email vagy jelszó.',
        ])->onlyInput('email');
    }
}