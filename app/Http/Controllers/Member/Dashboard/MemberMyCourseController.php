<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Course;
use App\Models\Transaction;
use App\Models\Submission;

class MemberMyCourseController extends Controller
{
    public function index() {
        $courses = Course::with(['users', 'transactions' => function ($query) {
            $query->where('user_id', Auth::user()->id);
            $query->where('status', 'success');
        }])->get();
        
        $total_course = Transaction::where('user_id', Auth::user()->id)->count();

        $submission = Submission::where('user_id', Auth::user()->id)->first();
        return view('member.dashboard.mycourse', compact('courses', 'submission', 'total_course'));
    }

    public function reqMentor(Request $requests, $id) {

        $user = Submission::where('user_id', $id)->first();

        if(!$user) {
            Submission::create([
                'status' => 'pending',
                'user_id' => $id
            ]);
        }

        Alert::success('success', 'Pengajuan Berhasil Di Kirim, Tunggu Sampai Admin Konfirmasi');
        return redirect()->route('member.dashboard');
    }
}