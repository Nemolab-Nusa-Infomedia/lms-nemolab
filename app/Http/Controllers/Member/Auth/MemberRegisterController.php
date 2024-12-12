<?php

namespace App\Http\Controllers\Member\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

// model yang di butuhkan
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;


class MemberRegisterController extends Controller
{
    // Sesi pertama: Form registrasi akun (hanya nama, email, dan password)
    public function index()
    {
        return view('member.auth.register'); // Tampilan sesi pertama
    }

    public function store(Request $requests)
    {
        $requests->validate([
            'name' => 'bail|required|string|max:255',
            'email' => 'bail|required|email|unique:users,email',
            'profession' => 'bail|required',
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
            'profession.required' => 'Profesi harus diisi',
            'password.required' => 'Password harus diisi',
            'password.regex' => 'Password harus berisi kombinasi huruf dan angka.',
            'password.min' => 'Panjang password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $avatar = null;

        if ($requests->hasFile('avatar')) {
            $requests->validate([
                'avatar' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
            ]);

            $getNameImageAvatar = $requests->avatar->getClientOriginalName();
            $avatar = Str::random(10) . $getNameImageAvatar;
            $requests->avatar->storeAs('public/images/avatars', $avatar);
        }

        $user = User::create([
            'avatar' => $avatar,
            'name' => $requests->name,
            'email' => $requests->email,
            'profession' => $requests->profession,
            'password' => Hash::make($requests->password),
        ]);

        // Kirim notifikasi verifikasi email
        $user->sendEmailVerificationNotification();
        event(new Registered($user));
        Auth::login($user);
        Alert::success('Success', 'Berhasil Mengirimkan PIN Verifikasi');
        return redirect()->route('verification.notice');
    }
}
