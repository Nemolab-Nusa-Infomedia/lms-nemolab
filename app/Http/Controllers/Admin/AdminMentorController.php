<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Submission;

class AdminMentorController extends Controller
{
    /**
     * tampilkan halaman admin entor
     * ambil data mentor saja
     */
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $mentors = User::where('role', 'mentor')->paginate($perPage);
        return view('admin.mentor.view', compact('mentors'));
    }

    /**
     *  tampilkan halaman form pembuatan mentor
     */
    public function create()
    {
        return view('admin.mentor.create');
    }

    /**
     * simpan data mentor baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'profession' => 'required|string|max:255',
            'password' => 'required|string|min:6', //minimal 6 karaker
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // password akan di hash
            'role' => 'mentor',
            'profession' => $request->profession,
        ]);

        Alert::success('Success', 'Data Mentor Berhasil Dibuat');
        return redirect()->route('admin.mentor');
    }

    public function edit(Request $requests)
    {
        $id = $requests->query('id');
        $mentor =  User::where('id', $id)->first();
        return view('admin.mentor.update    ', compact('mentor'));
    }

    public function update(Request $request, $id)
    {
        $mentor = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $mentor->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|string',
            'profession' => 'required|string|max:255',
        ]);

        $mentor->update([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'profession' => $request->profession,
            'password' => $request->filled('password') ? Hash::make($request->password) : $mentor->password,
        ]);

        Alert::success('Success', 'Data Mentor Berhasil Diupdate');
        return redirect()->route('admin.mentor');
    }

    /**
     * hapus mentor sekaligus avatar
     */
    public function delete(Request $requests)
    {
        $id = $requests->query('id');
        $mentor =  User::where('id', $id)->first();

        if ($mentor->avatar && $mentor->avatar !== 'null') {
            $avatarPath = 'public/images/avatars/' . $mentor->avatar;
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }
        }

        $mentor->delete();

        Alert::success('Success', 'Data Mentor Berhasil Dihapus');
        return redirect()->route('admin.mentor');
    }
}
