<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MentorMiddleware
{
    /**
     * Membuat Pengecekan request sebelum diterima
     * 
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pengecekan apakah user sudah login dan jenis user adalah mentor(bukan superadmin dan bukan student)
        if (Auth::check() && Auth::user()->role != 'students') {
            return $next($request);
        }

        return redirect()->route('admin.login')->with('error', 'You do not have access.');
    }
}
