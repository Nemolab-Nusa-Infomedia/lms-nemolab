<?php

namespace App\Http\Controllers\Member\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class   VerifpassController extends Controller
{
    public function index()
    {
        // Kirim notifikasi verifikasi email
        $user = User::find(Auth::user()->id);
        $user->sendEmailVerificationNotification();
        Alert::success('Success', 'Berhasil Mengirimkan PIN Verifikasi');
        return redirect()->route('member.setting.verifikasi-password');
        // return view('member.dashboard.setting.verifikasi-password');
    }

    public function resend(Request $requests)
    {
        $user = User::find(Auth::user()->id);
        $user->sendEmailVerificationNotification();
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

        if ($user->verification_pin === $request->pin) {
            $user->email_verified_at = now();
            $user->verification_pin = null; // Clear the PIN after successful verification
            $user->save();

            Alert::success('Success', 'Akun Anda Berhasil Terverifikasi');

            return redirect()->route('member.setting.reset-password');
        }

        Alert::error('Error', 'PIN Verifikasi Tidak Valid');
        return back();
    }
}