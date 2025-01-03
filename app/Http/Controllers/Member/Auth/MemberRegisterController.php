<?php

namespace App\Http\Controllers\Member\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Notifications\CustomVerifyEmailNotification;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class MemberRegisterController extends Controller
{
    public function index()
    {
        return view('member.auth.register');
    }

    public function store(Request $requests)
    {
        $requests->validate([
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|email|unique:users,email',
            'password' => [
                'bail',
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'confirmed',
            ],
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.regex' => 'Password harus berisi kombinasi huruf dan angka.',
            'password.min' => 'Panjang password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $requests->name,
            'email' => $requests->email,
            'password' => Hash::make($requests->password),
        ]);

        $user->notify(new CustomVerifyEmailNotification(false)); 
        Auth::login($user);
        Alert::success('Success', 'Berhasil Mengirimkan PIN Verifikasi');
        return redirect()->route('verification.notice');
    }
}
