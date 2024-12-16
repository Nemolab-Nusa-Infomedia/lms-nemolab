<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class ResendEmailVerif extends Controller
{
    public function index()
    {
        // return view('member.auth.verify-email');
    }

    public function resend(Request $requests)
    {
        $e=$requests->user()->sendEmailVerificationNotification();
        RateLimiter::hit('verification-email:' . Auth::user()->id, 3600);
        Alert::success('Success', 'PIN Verifikasi Telah Dikirim');
        // return redirect()->back();
        return response()->json($e);
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
            
            if ($user->role != 'students') {
                return redirect()->route('admin.course');
            }
            return redirect()->route('home');
        }

        Alert::error('Error', 'PIN Verifikasi Tidak Valid');
        return back();
    }

    // // Handler untuk email verifikasi
    // public function handler(EmailVerificationRequest $request, $id, $hash) // Perbaiki nama parameter dari $requests menjadi $request
    // {
    //     $request->fulfill(); // Panggil method fulfill untuk menyelesaikan verifikasi

    //     Alert::success('Success', 'Akun Anda Berhasil Terverifikasi');
    //     if (Auth::user()->role != 'students') {
    //         return redirect()->route('admin.course');
    //     }
    //     return redirect()->route('member.setting'); // Redirect dengan pesan
    // }
}
