<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class MemberSettingController extends Controller
{

    // public function editProfile()
    // {
    //     return view('member.dashboard.setting.edit_profile');
    // }
    // public function editEmail()
    // {
    //     return view('member.dashboard.setting.edit_email');
    // }
    // public function editPassword()
    // {
    //     return view('member.dashboard.setting.edit_password');
    // }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:1048',
            'profession' => 'required|string|max:255',
        ],
            [
                'name.max' => 'Panjang Nama Harus 50 character',
                'avatar.mimes' => 'Format gambar yang diperbolehkan: JPG, JPEG, PNG, SVG.',
                'avatar.max' => 'Ukuran gambar maksimal 2MB.'
            ]);

        $user = User::findOrFail(Auth::id());
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->profession = $request->input('profession');

        if ($request->hasFile('avatar')) {

            if ($user->avatar && Storage::exists('public/images/avatars/' . $user->avatar)) {
                Storage::delete('public/images/avatars/' . $user->avatar);
            }

            $avatar = $request->file('avatar')->store('images/avatars', 'public');
            $user->avatar = basename($avatar);
        }

        $user->save();

        Alert::success('Profile Berhasil Di Update');
        return redirect()->route('member.setting');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email|max:255',
        ],
        [
            'new_email.unique' => 'Email Sudah Digunakan',
        ]);

        $user = User::findOrFail(Auth::id());
        $user->email = $request->input('new_email');
        $user->save();

        Alert::success('Email Berhasil Diupdate');
        return redirect()->route('member.setting');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', 
                'regex:/[0-9]/', 
            ],
            'new_password_confirmation' => 'required|string|same:new_password',
        ], [
            'old_password.required' => 'Harap masukkan kata sandi lama Anda.',
            'new_password.required' => 'Harap masukkan kata sandi baru.',
            'new_password.min' => 'Kata sandi baru harus minimal 8 karakter.',
            'new_password.regex' => 'Kata sandi baru harus berisi huruf dan angka.',
            'new_password_confirmation.required' => 'Harap konfirmasi kata sandi baru Anda.',
            'new_password_confirmation.same' => 'Konfirmasi kata sandi tidak cocok.',
        ]);
    
        $user = User::findOrFail(Auth::id());
    
        // Validasi kata sandi lama
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->route('member.setting.reset-password')
                ->withErrors(['old_password' => 'Kata sandi lama yang Anda masukkan salah.'])
                ->withInput();
        }
    
        // Update kata sandi
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
    
        // Pesan sukses
        Alert::success('Berhasil!', 'Kata sandi Anda berhasil diperbarui.');
        return redirect()->route('member.setting');
    }
    
}
