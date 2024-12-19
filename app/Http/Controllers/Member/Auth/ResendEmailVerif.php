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
        return view('member.auth.verify-email');
    }

    public function resend(Request $requests)
    {
        $user = User::find(Auth::user()->id);
        $user->notify(new CustomVerifyEmailNotification(false)); // true for password verification
        RateLimiter::hit('verification-email:' . Auth::user()->id, 3600);
        Alert::success('Success', 'PIN Verifikasi Telah Dikirim');
        return redirect()->back();
    }

    public function verifyPin(Request $request)
    {
        $request->validate([
            'pin' => 'required|string|size:4'
        ]);

        $user = Auth::user();

        // Check if PIN has expired
        if ($user->pin_expires_at < now()) {
            Alert::error('Error', 'PIN Verifikasi Telah Kadaluarsa');
            return back();
        }

        if ($user->verification_pin === $request->pin) {
            $user->email_verified_at = now();
            $user->verification_pin = null;
            $user->pin_expires_at = null; // Clear expiration timestamp
            $user->save();

            Alert::success('Success', 'Akun Anda Berhasil Terverifikasi');

            if ($user->role != 'students') {
                return redirect()->route('admin.course');
            }
            return redirect()->route('home');
        }

        Alert::error('Error', 'PIN Verifikasi Tidak Valid');
        return back();
    }
}