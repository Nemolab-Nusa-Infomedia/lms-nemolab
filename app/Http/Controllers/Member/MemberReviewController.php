<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Ebook;

class MemberReviewController extends Controller
{
/**
 * Menampilkan daftar review untuk sebuah kursus.
 */
public function index($slug)
{
    // Mencari kursus berdasarkan slug, jika tidak ditemukan akan mengembalikan 404
    $course = Course::where('slug', $slug)->firstOrFail();

    // Memeriksa apakah pengguna sudah membeli kursus tersebut
    $checkTrx = Transaction::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();

    if ($checkTrx) {
        // Jika sudah membeli, tampilkan halaman review untuk kursus tersebut
        return view('member.review', compact('course'));
        } else {
            // Jika belum membeli, tampilkan pesan error dan arahkan kembali ke halaman bergabung kursus
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }

    /**
     * Menyimpan review baru yang dibuat.
     */
    public function store(Request $request)
    {
        // Validasi input dari form review
        $validated = $request->validate([
            'course_id' => 'required|exists:tbl_courses,id', // Memastikan kursus yang direview ada di database
            'note' => 'nullable|string|min:1|max:100', // Catatan review, bersifat opsional dan dibatasi panjangnya
        ]);

        // Mencari kursus berdasarkan ID yang divalidasi
        $course = Course::findOrFail($validated['course_id']);

        // Memeriksa apakah pengguna sudah memberikan review untuk kursus ini
        $checkReview = Review::where('user_id', Auth::user()->id)
            ->where('course_id', $course->id)
            ->first();

        if ($checkReview) {
            // Jika sudah memberi review, tampilkan pesan error
            Alert::error('error', 'Anda Sudah Melakukan Review.');
            return redirect()->route('member.course.detail', ['slug' => $course->slug])
                ->with('error', 'Review gagal ditambahkan.');
        } else {
            // Jika belum memberi review, simpan review baru
            Review::create([
                'user_id' => Auth::id(),
                'course_id' => $validated['course_id'],
                'note' => $validated['note'],
            ]);
            // Tampilkan pesan sukses setelah review berhasil disimpan
            Alert::success('success', 'Review berhasil ditambahkan.');

            // Redirect kembali ke halaman detail kursus
            return redirect()->route('member.course.detail', ['slug' => $course->slug]);
        }
    }

    /**
     * Menampilkan form untuk memberikan review pada eBook.
     */
    public function ebookFormReview($slug)
    {
        // Mencari eBook berdasarkan slug
        $ebook = Ebook::where('slug', $slug)->firstOrFail();

        // Memeriksa apakah pengguna sudah membeli eBook tersebut
        $checkTrx = Transaction::where('ebook_id', $ebook->id)->where('user_id', Auth::user()->id)->first();

        if ($checkTrx) {
            // Jika sudah membeli eBook, tampilkan form review untuk eBook tersebut
            return view('member.review-ebook', compact('ebook'));
        } else {
            // Jika belum membeli, tampilkan pesan error dan arahkan pengguna untuk membeli eBook terlebih dahulu
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.ebook.join', $slug);
        }
    }

    /**
     * Menyimpan review baru untuk eBook.
     */
    public function storeReviewEbook(Request $request)
    {
        // Validasi input dari form review untuk eBook
        $validated = $request->validate([
            'ebook_id' => 'required|exists:tbl_ebooks,id', // Memastikan eBook yang direview ada di database
            'note' => 'nullable|string|min:1|max:100', // Catatan review, bersifat opsional dan dibatasi panjangnya
        ]);

        // Mencari eBook berdasarkan ID yang divalidasi
        $ebook = Ebook::findOrFail($validated['ebook_id']);

        // Memeriksa apakah pengguna sudah memberikan review untuk eBook ini
        $checkReview = Review::where('user_id', Auth::user()->id)->where('ebook_id', $ebook->id)->first();
        if ($checkReview) {
            // Jika sudah memberi review, tampilkan pesan error
            Alert::error('error', 'Anda Sudah Melakukan Review');
            return redirect()->route('member.ebook.detail', ['slug' => $ebook->slug])
                ->with('error', 'Review gagal ditambahkan.');
        } else {
            // Jika belum memberi review, simpan review baru
            Review::create([
                'user_id' => Auth::id(),
                'ebook_id' => $validated['ebook_id'],
                'note' => $validated['note'],
            ]);
            // Tampilkan pesan sukses setelah review berhasil disimpan
            Alert::success('success', 'Komentar berhasil ditambahkan.');
            // Redirect kembali ke halaman detail eBook
            return redirect()->route('member.ebook.read', ['slug' => $ebook->slug])
                ->with('success', 'Review berhasil ditambahkan.');
        }
    }

}
