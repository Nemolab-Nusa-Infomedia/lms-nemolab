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

class VerifpassController extends Controller
{
    public function resend(Request $requests)
    {
        $user = User::find(Auth::user()->id);
        $user->notify(new CustomVerifyEmailNotification(true)); 
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

        if ($user->pin_expires_at < now()) {
            return back()->with('alert', ['type' => 'error', 'message' => 'PIN Verifikasi Telah Kadaluarsa']);
        }

        if ($user->verification_pin === $request->pin) {
            $user->email_verified_at = now();
            $user->verification_pin = null;
            $user->pin_expires_at = null; 
            $user->save();

            return redirect()->route('member.setting')->with('alert', ['type' => 'success', 'message' => 'Kata sandi Anda berhasil diperbarui.']);
        }

        return back()->with('alert', ['type' => 'error', 'message' => 'PIN Verifikasi Tidak Valid']);
    }
}