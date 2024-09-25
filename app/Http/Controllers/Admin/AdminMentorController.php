<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use App\Models\Submission;

class AdminMentorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $mentors = User::where('role', 'mentor')->paginate($perPage);
        return view('admin.mentor.view', compact('mentors'));
    }

    public function create()
    {
        return view('admin.mentor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'avatar' => 'default.png',
            'password' => Hash::make($request->password),
            'role' => 'mentor',
        ]);

        Alert::success('Success', 'Data Mentor Berhasil Di Buat');
        return redirect()->route('admin.mentor');
    }

    public function edit($id)
    {
        $mentor = User::where('id', $id)->first();

        return view('admin.mentor.edit', compact('mentor'));
    }

    public function update(Request $request, $id)
    {
        $mentor = User::where('id', $id)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $mentor->id,
            'password' => 'nullable|string|min:6',
            'role' => 'required'
        ]);

        if($request->role == 'students') {
            $submission = Submission::where('user_id', $id)->first();
            if(isset($submission)) {
                $submission->delete();
            }
        }

        $mentor->update([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->filled('password') ? Hash::make($request->password) : $mentor->password,
        ]);

        Alert::success('Success', 'Data Mentor Berhasil Di Update');
        return redirect()->route('admin.mentor');
    }

    public function destroy($id)
    {
        $mentor = User::where('id', $id)->first();

        if ($mentor->avatar) {
            $avatarPath = 'public/images/avatars/' . $mentor->avatar;
            
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }
        }
    
        $mentor->delete();

        Alert::success('Success', 'Data Mentor Berhasil Di Hapus');
        return redirect()->route('admin.mentor');
    }
}