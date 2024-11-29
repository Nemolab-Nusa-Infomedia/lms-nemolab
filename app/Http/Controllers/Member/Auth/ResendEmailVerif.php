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
        return view('member.auth.verify-email');
    }

    public function resend(Request $requests)
    {
        $requests->user()->sendEmailVerificationNotification();

        RateLimiter::hit('verification-email:' . Auth::user()->id, 3600);

        Alert::success('Success', 'Berhasil Mengirimkan Tautan Verifikasi');
        return redirect()->back();
    }

    // Handler untuk email verifikasi
    public function handler(EmailVerificationRequest $request, $id, $hash) // Perbaiki nama parameter dari $requests menjadi $request
    {
        $request->fulfill(); // Panggil method fulfill untuk menyelesaikan verifikasi

        Alert::success('Success', 'Akun Anda Berhasil Terverifikasi');
        if (Auth::user()->role != 'students') {
            return redirect()->route('admin.course');
        }
        return redirect()->route('member.setting'); // Redirect dengan pesan
    }
}
