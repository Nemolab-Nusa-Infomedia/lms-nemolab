<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
class AdminLoginController extends Controller
{
    // Method untuk menampilkan halaman login
    public function index()
    {
        // Periksa apakah pengguna sudah login
        if (Auth::check()) {
            // Jika pengguna bukan student, arahkan ke halaman admin
            if (Auth::user()->role != 'students') {
                return redirect()->route('admin.course');
            }
            // Jika pengguna adalah siswa, arahkan ke halaman utama
            return redirect()->route('home');
        }
        // Jika belum login, tampilkan halaman login admin
        return view('admin.auth.login');
    }

    // Method untuk menangani proses login
    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email', // Email harus diisi dan berformat email
            'password' => 'required',   // Password harus diisi
        ]);

        // Jika pengguna sudah login, logout terlebih dahulu
        if (Auth::check()) {
            Auth::logout();                        // Logout pengguna
            $request->session()->invalidate();     // Hapus sesi
            $request->session()->regenerateToken(); // Buat regenari ulang token
        }

        // Ambil data pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Coba login dengan email dan password
            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate(); // Regenerasi sesi untuk keamanan

                // Periksa apakah pengguna adalah siswa
                if ($user->role === 'students') {
                    Alert::error('Error', 'Maaf Anda Tidak Memiliki Akses Untuk Halaman Ini!');
                    return redirect()->route('home'); // Arahkan ke halaman utama jika siswa
                }

                // Jika berhasil login dan bukan siswa, arahkan ke halaman admin
                Alert::success('Success', 'Login successful.');
                return redirect()->route('admin.course');
            } else {
                // Jika password salah, kembalikan ke halaman login dengan pesan error
                return redirect()
                    ->back()
                    ->withErrors(['password' => 'Incorrect password.'])
                    ->withInput();
            }
        } else {
            // Jika email tidak terdaftar, kembalikan ke halaman login dengan pesan error
            return redirect()
                ->back()
                ->withErrors(['email' => 'Email not registered.'])
                ->withInput();
        }
    }

    // Method untuk menangani logout
    public function logout(Request $request)
    {
        Auth::logout();                        // Logout pengguna
        $request->session()->invalidate();     // Hapus sesi
        $request->session()->regenerateToken(); // Regenerasi token sesi

        // Tampilkan pesan sukses dan arahkan ke halaman login
        Alert::success('Success', 'Logout successful.');
        return redirect()->route('admin.login');
    }
}
