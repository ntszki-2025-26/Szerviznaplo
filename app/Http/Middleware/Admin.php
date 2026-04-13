<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || (int) Auth::user()->role !== 2) {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}