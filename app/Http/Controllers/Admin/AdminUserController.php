<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $users
        ], 200);
    }

    public function create() {
        // Method can be removed or implemented if needed for a view
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:students,mentor,superadmin',
        ]);
    
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = Str::random(10) . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/images/avatars', $avatarName);
        }
    
        $user = User::create([
            'name' => $request->name,
            'avatar' => $avatarName ?? null,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:students,mentor,superadmin',
        ]);
    
        $user = User::where('id', $id)->first();
    
        $avatarName = $user->avatar;
        if ($request->hasFile('avatar')) {
            if ($avatarName && Storage::exists('public/images/avatars/' . $avatarName)) {
                Storage::delete('public/images/avatars/' . $avatarName);
            }
    
            $avatar = $request->file('avatar');
            $avatarName = Str::random(10) . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/images/avatars', $avatarName);
        }
    
        $user->update([
            'name' => $request->name,
            'avatar' => $avatarName,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);
    
        return response()->json([
            'message' => 'User updated successfully'
        ], 200);
    }
    

    public function delete($id) {
        $user = User::where('id', $id)->first();
    
        if ($user->avatar) {
            $avatarPath = 'public/images/avatars/' . $user->avatar;
            
            if (Storage::exists($avatarPath)) {
                if (Storage::delete($avatarPath)) {
                    $user->delete();
                    return response()->json([
                        'message' => 'User and avatar deleted successfully'
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Failed to delete avatar'
                    ], 500);
                }
            } else {
                $user->delete();
                return response()->json([
                    'message' => 'User deleted successfully, but avatar does not exist'
                ], 200);
            }
        } else {
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully'
            ], 200);
        }
    }    
    
}