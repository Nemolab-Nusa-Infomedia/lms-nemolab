<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Submission;
use App\Models\Course;
use App\Models\User;
use App\Mail\MailNotificationMentor;
use App\Notifications\sendSubmissionMentorNotification;

class AdminSubmissionController extends Controller
{
    // Menampilkan daftar mentor dengan data kursus dan status pengajuan
    public function index()
    {
        // Ambil semua pengguna dari database
        $users = User::all();

        // Map data pengguna untuk mendapatkan mentor dengan jumlah kursus dan status pengajuan
        $mentorsWithCourses = $users->map(function ($mentor) {
            // Hitung jumlah kursus yang telah berhasil dibeli oleh pengguna
            $total_course = Course::whereHas('transactions', function ($query) use ($mentor) {
                $query->where('user_id', $mentor->id)
                    ->where('status', 'success'); // Hanya transaksi dengan status 'success'
            })->count();

            // Periksa apakah ada pengajuan untuk pengguna
            $submission_check = Submission::where('user_id', $mentor->id)->first();

            // Ambil status pengajuan, default 'pending' jika tidak ditemukan
            $status_submission = $submission_check?->status ?? 'pending';
            return [
                'mentor' => $mentor,
                'total_course' => $total_course,
                'submission_status' => $status_submission
            ];
        });

        // Kembalikan view 'admin.pengajuan-mentor.view' dengan data mentor
        return view('admin.pengajuan-mentor.view', compact('mentorsWithCourses'));
    }

    // Menyimpan pengajuan mentor
    public function store(Request $requests, $id)
    {
        // Validasi input dari permintaan
        $requests->validate([
            'link' => 'required|url',
            'action' => 'required|in:pending,accept',
        ]);

        Submission::create([
            'status' => 'accept',
            'user_id' => $id,
        ]);

        // Cari data pengajuan berdasarkan pengguna
        $submission = Submission::where('user_id', $id)->first();

        // Kirim notifikasi email ke pengguna terkait pengajuan
        $submission->user->notify(new sendSubmissionMentorNotification($submission, $requests->link));

        // Tampilkan notifikasi sukses dan redirect ke halaman pengajuan
        return redirect()->route('admin.pengajuan')->with('alert', ['type' => 'success', 'message' => 'Data Berhasil Dibuat!']);
    }
}
