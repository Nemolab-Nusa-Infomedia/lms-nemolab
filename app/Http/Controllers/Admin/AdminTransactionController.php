<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Transaction;
use App\Models\Course;
use App\Models\Ebook;
use App\Models\MyListCourse;
use App\Models\CourseEbook;

class AdminTransactionController extends Controller
{
    // Menampilkan daftar transaksi berdasarkan peran pengguna
    public function index(Request $request)
    {
        // Ambil jumlah item per halaman, default 10
        $perPage = $request->input('per_page', 10);
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();
        // Filter data berdasarkan peran pengguna
        if (Auth::user()->role == 'superadmin') {
            // Jika superadmin, ambil semua ID kursus dan eBooks yang tidak terhubung dengan bundling (courseEbooks)
            $courses = Course::pluck('id');
            $ebooks = Ebook::doesntHave('courseEbooks')->pluck('id');
        } else {
            // Jika mentor, ambil ID kursus dan eBooks milik mentor yang sedang login
            $courses = Course::where('mentor_id', $userId)->pluck('id');
            $ebooks = Ebook::where('mentor_id', $userId)
                ->doesntHave('courseEbooks') // Hanya eBooks yang tidak terhubung ke bundling
                ->pluck('id');
        }
        
        // Ambil transaksi yang terkait dengan kursus
        $transactionCourses = Transaction::with('course')
            ->whereIn('course_id', $courses)
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END") // Urutkan status 'pending' lebih dulu
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal dibuat
            ->paginate($perPage); // Batasi jumlah data per halaman
        
        // Ambil transaksi yang terkait dengan eBooks
        $transactionEbooks = Transaction::with('ebook')
            ->whereIn('ebook_id', $ebooks)
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END") // Urutkan status 'pending' lebih dulu
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal dibuat
            ->paginate($perPage); // Batasi jumlah data per halaman
        
        // Ambil data bundling (kombinasi kursus dan eBooks) ini digunakan untuk mengecek apakah course adalah bundle
        // contoh cara pake terdapat di MemberCourseController pada methode index dan join
        $bundling = CourseEbook::whereIn('course_id', $courses)->get();
        return view('admin.transaction.view', compact('transactionCourses', 'transactionEbooks', 'bundling'));
    }
    
    // Menerima transaksi dan mengubah statusnya menjadi 'success'
    public function accept($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);
        
        // Ubah status transaksi menjadi 'success'
        $transaction->status = 'success';
        $transaction->save();

        // Tambahkan kursus atau eBooks ke daftar pengguna
        MyListCourse::create([
            'user_id' => $transaction->user_id,
            'course_id' => $transaction->course_id,
            'ebook_id' => $transaction->ebook_id,
            'bundle_id' => $transaction->bundle_id, // Jika transaksi adalah bundling
        ]);

        // Tampilkan notifikasi sukses dan redirect ke daftar transaksi
        Alert::success('Success', 'Transctions Berhasil Di Accept');
        return redirect()->route('admin.transaction');
    }

    // Membatalkan transaksi dan mengubah statusnya menjadi 'failed'
    public function cancel($id)
    {
        // Cari transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);
        
        // Ubah status transaksi menjadi 'failed'
        $transaction->status = 'failed';
        $transaction->save();

        // Tampilkan notifikasi sukses dan redirect ke daftar transaksi
        Alert::success('Success', 'Transctions Berhasil Di Cancel');
        return redirect()->route('admin.transaction');
    }
}
