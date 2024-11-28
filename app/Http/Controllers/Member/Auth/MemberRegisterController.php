<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

// model yang di butuhkan
use App\Models\User;


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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'profession' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
        ], [
            // ini pesan error [targer].[condition]
            'email.unique' => 'Email sudah terdaftar',
            'password.regex' => 'Panjang password harus 8 karakter berisi kombinasi huruf dan angka.',
            'avatar.mimes' => 'Format gambar yang diperbolehkan: JPG, JPEG, PNG, SVG.',
            'avatar.max' => 'Ukuran gambar maksimal 2MB.',
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
        Alert::success('Success', 'Berhasil Mengirimkan Tautan Verifikasi');
        return redirect()->route('verification.notice');
    }    
}
