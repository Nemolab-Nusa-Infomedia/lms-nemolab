<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class AdminForumController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);
        if ($user->role === 'superadmin') {
            $forums = Forum::paginate($perPage);
        } else {
            $forums = Forum::where('user_id', $user->id)->paginate($perPage);
        }
        return view('admin.forum.view', compact('forums'));
    }
}
