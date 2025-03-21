<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;

class MemberLoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('member.auth.login');
    }

    public function login(Request $requests)
    {

        $requests->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            // ini pesan error [target].[condition]
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Harap masukkan email yang valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);
        if (Auth::check()) {
            Auth::logout();
            $requests->session()->invalidate();
            $requests->session()->regenerateToken();
        }

        // Cek apakah email ada di database
        $user = User::where('email', $requests->email)->first();
        $credentials = $requests->only('email', 'password');

        if ($user) {
            // Jika email ada, periksa password
            if (Auth::attempt($credentials)) {
                $requests->session()->regenerate();
                return redirect()->route('home')->with('alert', ['type' => 'success', 'message' => 'Login Berhasil']);
            } else {
                // Log::warning('Login gagal: Password salah untuk email: ' . $email);
                return redirect()->back()->withErrors(['password' => 'Password salah.'])->withInput();
            }
        } else {
            // Log::warning('Login gagal: Email tidak ditemukan: ' . $email);
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $role = Auth::user()->role;
        Auth::logout();
        // Log::info('Logout Berhasil ');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($role != 'students') {
            return redirect()->route('admin.login')->with('alert', ['type' => 'success', 'message' => 'Logout Berhasil']);
        }
        return redirect()->route('member.login')->with('alert', ['type' => 'success', 'message' => 'Logout Berhasil']);
    }
}
