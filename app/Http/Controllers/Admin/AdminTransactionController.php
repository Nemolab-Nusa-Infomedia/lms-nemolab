<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Transaction;
use App\Models\Course;
use App\Models\MyListCourse;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $userId = Auth::id();

        if (Auth::user()->role == 'superadmin') {
            // Jika user adalah superadmin, tampilkan semua transaksi
            $transactions = Transaction::with('course')
                ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END") // Mengurutkan status pending di atas
                ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal
                ->paginate($perPage);
        } else {
            // Jika user bukan superadmin, ambil kursus yang dibuat oleh mentor
            $courses = Course::where('mentor_id', $userId)->pluck('id'); // Ambil hanya ID kursus

            // Ambil semua transaksi berdasarkan kursus yang dimiliki oleh mentor
            $transactions = Transaction::with('course')
                ->whereIn('course_id', $courses) // Mengambil transaksi yang cocok
                ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END") // Mengurutkan status pending di atas
                ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal
                ->paginate($perPage);
        }

        // Mengembalikan view dengan transaksi
        return view('admin.transaction.view', compact('transactions'));
    }

    public function accept($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'success';
        $transaction->save();
        MyListCourse::create([
            'user_id' => $transaction->user_id,
            'course_id' => $transaction->course_id,
        ]);

        Alert::success('Success', 'Transctions Berhasil Di Accept');
        return redirect()->route('admin.transaction');
    }

    public function cancel($id)
    {
        // $transaction = Transaction::findOrFail($id);
        // $transaction->delete();
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'failed';
        $transaction->save();

        Alert::success('Success', 'Transctions Berhasil Di Cancel');
        return redirect()->route('admin.transaction');
    }
}
