<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;
use App\Models\CompleteEpisodeCourse;
use App\Models\MyListCourse;
use Symfony\Component\Console\Command\CompleteCommand;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $students = User::where('role', 'students')->get();
        return view('admin.member.view', compact('students'));
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'profession' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'students',
            'profession' => $request->profession,
        ]);

        return redirect()->route('admin.student')->with('alert', ['type' => 'success', 'message' => 'Data Berhasil Dibuat!']);
    }

    public function edit(Request $requests)
    {
        $id = $requests->query('id');
        $student =  User::where('id', $id)->first();
        return view('admin.member.update', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student =  User::where('id', $id)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $student->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profession' => 'nullable|string|max:255',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'password' => $request->filled('password') ? Hash::make($request->password) : $student->password,
        ]);

        return redirect()->route('admin.student')->with('alert', ['type' => 'info', 'message' => 'Data Berhasil Diubah!']);
    }

    public function delete(Request $requests)
    {
        $id = $requests->query('id');
        $student = User::where('id', $id)->first();

        if ($student->avatar && $student->avatar !== 'null') {
            $avatarPath = 'public/images/avatars/' . $student->avatar;
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }
        }


        Transaction::where('user_id', $student->id)->delete();
        MyListCourse::where('user_id', $student->id)->delete();
        CompleteEpisodeCourse::where('user_id', $student->id)->delete();
        $student->delete();

        return redirect()->route('admin.student')->with('alert', ['type' => 'error', 'message' => 'Data Berhasil Dihapus!']);
    }
}
