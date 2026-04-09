<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:0,1,2'
        ]);
        $user->update(['role' => $request->role]);
        return back()->with('success', 'Szerepkör frissítve!');
    }
    public function dashboard()
    {
    return view('admin.dashboard', [
        'totalUsers'    => User::count(),
        'adminCount'    => User::where('role', 2)->count(),
        'mechanicCount' => User::where('role', 1)->count(),
        'userCount'     => User::where('role', 0)->count(),
    ]);
    }
}