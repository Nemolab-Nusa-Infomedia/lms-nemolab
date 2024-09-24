<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $students = User::where('role', 'students')->paginate($perPage);
        return view('admin.member.view', [
            'students' => $students
        ]);
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->name,
            'avatar' => 'default.png',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'students',
        ]);

        Alert::success('Success', 'Data Member Berhasil Di Buat');
        return redirect()->route('admin.member');
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('admin.member.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        $student = User::where('id', $id)->first();
        $student->name = $request->name;
        $student->username = $request->name;
        $student->email = $request->email;
        if ($request->password) {
            $student->password = bcrypt($request->password);
        }
        
        $student->save();

        Alert::success('Success', 'Data Member Berhasil Di Update');
        return redirect()->route('admin.member');
    }

    public function destroy($id)
    {
        $student = User::where('id', $id)->first();
    
        if ($student->avatar) {
            $avatarPath = 'public/images/avatars/' . $student->avatar;
            
            if (Storage::exists($avatarPath)) {
                if (Storage::delete($avatarPath)) {
                    $message = 'Student and avatar deleted successfully';
                } else {
                    return response()->json([
                        'message' => 'Failed to delete avatar'
                    ], 500);
                }
            } else {
                $message = 'Student deleted successfully, but avatar does not exist';
            }
        } else {
            $message = 'Student deleted successfully';
        }
    
        $student->delete();
        Alert::success('Success', 'Data Member Berhasil Di Hapus');
        return redirect()->route('admin.member');
    }
}