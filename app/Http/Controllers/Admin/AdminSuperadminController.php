<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSuperadminController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $superadmins = User::where('role', 'superadmin')->paginate($perPage);
        return view('admin.superadmin.view', compact('superadmins'));
    }

    public function create()
    {
        return view('admin.superadmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->name, 
            'avatar' => 'default.png',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'superadmin',
        ]);

        Alert::success('Success', 'Data Superadmin Berhasil Di Buat');
        return redirect()->route('admin.superadmin');
    }

    public function edit($id)
    {
        $superadmin = User::findOrFail($id);
        return view('admin.superadmin.edit', compact('superadmin'));
    }

    public function update(Request $request, $id)
    {
        $superadmin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $superadmin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $superadmin->update([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $superadmin->password,
        ]);

        Alert::success('Success', 'Data Superadmin Berhasil Di Update');
        return redirect()->route('admin.superadmin');
    }

    public function destroy($id)
    {
        $superadmin = User::findOrFail($id);
        
        if ($superadmin->avatar) {
            $avatarPath = 'public/images/avatars/' . $superadmin->avatar;
            
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }
        }
    
        $superadmin->delete();

        Alert::success('Success', 'Data Superadmin Berhasil Di Hapus');
        return redirect()->route('admin.superadmin');
    }
}