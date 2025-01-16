<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Course;
use App\Models\CourseEbook;
use App\Models\Ebook;
use App\Models\User;


class AdminCourseEbookController extends Controller
{
    /**
     * Menampilkan daftar paket kelas pada halaman admin
     */
    public function index(Request $requests)
    {
        // Ambil semua data CourseEbook dengan relasi ke course dan ebook
        $paketKelas = CourseEbook::with(['course', 'ebook'])->get();

        // Inisialisasi variabel users
        $users = null;

        // Jika ada data paket kelas dan terdapat course terkait
        if ($paketKelas->isNotEmpty() && $paketKelas->first()->course) {
            // Ambil user berdasarkan mentor_id dari course pertama dalam paket kelas
            $users = User::where('id', $paketKelas->first()->course->mentor_id)->first();
        }

        $user = Auth::user(); // Ambil data user yang sedang login

        // Jika user adalah mentor, ambil hanya course dan ebook dimiliki mentor
        $courses = Course::where('mentor_id', Auth::user()->id)
            ->where('status', 'published')
            ->whereDoesntHave('courseEbooks')
            ->get();
        $ebooks = Ebook::where('mentor_id', Auth::user()->id)
            ->where('status', 'published')
            ->whereDoesntHave('courseEbooks')
            ->get();

        // Tampilkan view untuk daftar paket kelas dengan data yang dibutuhkan
        return view('admin.paket-kelas.view', compact('paketKelas', 'users', 'courses', 'ebooks'));
    }

    /**
     * Menampilkan halaman untuk membuat paket kelas baru
     */
    public function create()
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        // Jika user adalah superadmin
        if ($user->role === 'superadmin') {
            // Ambil course dan ebook yang belum memiliki relasi di tabel course_ebooks
            $courses = Course::with('users')
                ->where('status', 'published')
                ->whereDoesntHave('courseEbooks')
                ->orderBy('id', 'DESC')
                ->get();
            $ebooks = Ebook::with('users')
                ->where('status', 'published')
                ->whereDoesntHave('courseEbooks')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            // Jika user adalah mentor, ambil hanya course dan ebook dimiliki mentor
            $courses = Course::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->whereDoesntHave('courseEbooks')
                ->get();
            $ebooks = Ebook::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->whereDoesntHave('courseEbooks')
                ->get();
        }

        return view('admin.paket-kelas.create', compact('courses', 'ebooks'));
    }

    /**
     * Menyimpan paket kelas baru ke database
     */
    public function store(Request $requests)
    {
        // Validasi input dari form
        $requests->validate([
            'name_course' => 'required',
            'name_ebook' => 'required',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:free,premium',
        ]);

        // Cari course dan ebook berdasarkan nama yang dipilih
        $course = Course::where('name', $requests->name_course)->first();
        $ebook = Ebook::where('name', $requests->name_ebook)->first();

        // Hitung harga paket (0.8/20% diskon jika premium)
        $harga = $requests->type === 'premium' 
            ? ($course->price + $ebook->price) * 0.8 
            : 0;

        // Simpan data paket ke database
        CourseEbook::create([
            'course_id' => $course->id,
            'ebook_id' => $ebook->id,
            'type' => $requests->type,
            'price' => $harga,
            'mentor_id' => Auth::user()->id,
        ]);


        return redirect()->route('admin.paket-kelas')->with('alert', ['type' => 'success', 'message' => 'Data Berhasil Dibuat!']);
    }

    /**
     * Menampilkan halaman edit untuk paket kelas
     */
    public function edit(Request $requests)
    {
        $id = $requests->query('id'); // Ambil ID dari query string
        $paketKelas = CourseEbook::with(['course', 'ebook'])->where('id', $id)->first();

        $user = Auth::user();

        // Ambil data course dan ebook sesuai dengan role user
        if ($user->role === 'superadmin') {
            $courses = Course::with('users')
                ->where('status', 'published')
                ->orderBy('id', 'DESC')
                ->get();
            $ebooks = Ebook::with('users')
                ->where('status', 'published')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $courses = Course::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->get();
            $ebooks = Ebook::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->get();
        }

        // Tampilkan halaman edit dengan data yang dibutuhkan
        return view('admin.paket-kelas.update', compact('courses', 'ebooks', 'paketKelas'));
    }

    /**
     * Memperbarui data paket kelas
     */
    public function update(Request $requests, $id)
    {
        // Validasi input dari form
        $requests->validate([
            'name_course' => 'required',
            'name_ebook' => 'required',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:free,premium',
        ]);

        // Cari data paket kelas berdasarkan ID
        $courseEbook = CourseEbook::where('id', $id)->firstOrFail();
        $course = Course::where('name', $requests->name_course)->firstOrFail();
        $ebook = Ebook::where('name', $requests->name_ebook)->firstOrFail();

        // Hitung harga paket (20% diskon jika premium)
        $harga = $requests->type === 'premium' 
            ? ($course->price + $ebook->price) * 0.8 
            : 0;

        // Update data paket kelas
        $courseEbook->update([
            'course_id' => $course->id,
            'ebook_id' => $ebook->id,
            'type' => $requests->type,
            'price' => $harga,
        ]);

        return redirect()->route('admin.paket-kelas')->with('alert', ['type' => 'info', 'message' => 'Data Berhasil Diperbarui!']);
    }

    /**
     * Menghapus data paket kelas
     */
    public function delete(Request $requests)
    {
        $id = $requests->query('id'); // Ambil ID dari query string

        // Cari paket kelas berdasarkan ID dan hapus
        $paket = CourseEbook::where('id', $id)->first();
        $paket->delete();

        return redirect()->route('admin.paket-kelas')->with('alert', ['type' => 'error', 'message' => 'Data berhasil dihapus!']);
    }

}
