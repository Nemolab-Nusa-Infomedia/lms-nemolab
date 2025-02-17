<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pengecekan apakah user sudah login dan jenis user adalah Superadmin
        if (Auth::check() && Auth::user()->role == 'superadmin') {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'You do not have access.');
    }
}