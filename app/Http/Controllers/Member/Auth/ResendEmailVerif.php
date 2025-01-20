<?php

namespace App\Http\Controllers\Member\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Notifications\CustomVerifyEmailNotification;

class ResendEmailVerif extends Controller
{
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->notify(new CustomVerifyEmailNotification(false)); 
        return view('member.auth.verify-email')->with('alert', ['type' => 'success', 'message' => 'PIN Verifikasi Telah Dikirim']);
    }

    public function resend(Request $requests)
    {
        $user = User::find(Auth::user()->id);
        $user->notify(new CustomVerifyEmailNotification(false)); 
        RateLimiter::hit('verification-email:' . Auth::user()->id, 3600);
        return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'PIN Verifikasi Telah Dikirim']);
    }

    public function verifyPin(Request $request)
    {
        $request->validate([
            'pin' => 'required|string|size:4'
        ]);

        $user = Auth::user();

        // Check if PIN has expired
        if ($user->pin_expires_at < now()) {
            return back()->with('alert', ['type' => 'error', 'message' => 'PIN Verifikasi Telah Kadaluarsa']);
        }

        if ($user->verification_pin === $request->pin) {
            $user->email_verified_at = now();
            $user->verification_pin = null;
            $user->pin_expires_at = null; 
            $user->save();

            if ($user->role != 'students') {
                return redirect()->route('admin.course')->with('alert', ['type' => 'success', 'message' => 'Akun Anda Berhasil Terverifikasi']);
            }
            return redirect()->route('home')->with('alert', ['type' => 'success', 'message' => 'Akun Anda Berhasil Terverifikasi']);
        }

        return back()->with('alert', ['type' => 'error', 'message' => 'PIN Verifikasi Tidak Valid']);
    }
}