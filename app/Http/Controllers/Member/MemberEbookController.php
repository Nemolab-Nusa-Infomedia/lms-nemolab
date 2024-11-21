<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\User;
use App\Models\CourseEbook;
use RealRashid\SweetAlert\Facades\Alert;


class MemberEbookController extends Controller
{
    public function index($slug)
    {
        // Mencari eBook berdasarkan slug yang diberikan
        $ebooks = Ebook::where('slug', $slug)->first();
    
        if ($ebooks) {
            // Mengambil semua review terkait eBook, termasuk data user yang memberikan review
            $reviews = Review::with('user')->where('ebook_id', $ebooks->id)->get();
    
            // Jika user sedang login, cari transaksi eBook milik user
            if (Auth::user()) {
                $transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('ebook_id', $ebooks->id)
                    ->orderBy('created_at', 'desc')
                    ->first(); // Ambil transaksi terbaru
            } else {
                $transaction = null; // Jika user tidak login, transaksi kosong
            }
    
            // Mengambil semua ID eBook yang termasuk dalam bundle
            $InBundle = CourseEbook::pluck('ebook_id')->toArray();
    
            // Menampilkan halaman join eBook dengan data yang dikirimkan
            return view('member.joinebook', compact('transaction', 'ebooks', 'reviews', 'InBundle'));
        } else {
            // Jika eBook tidak ditemukan, arahkan ke halaman error
            return redirect('pages.error');
        }
    
        // Mengembalikan view meskipun tidak pernah tercapai karena return sebelumnya
        return view('member.joinebook', compact('transaction', 'ebooks', 'reviews'));
    }
    
    public function read($slug)
    {
        // Cari eBook berdasarkan slug yang diberikan, jika tidak ditemukan maka gagal
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
    
        // Memeriksa apakah user sudah memberikan review untuk eBook ini
        $checkReview = Review::where('user_id', Auth::user()->id)->where('ebook_id', $ebook->id)->first();
    
        // Memeriksa apakah user memiliki transaksi yang valid untuk eBook ini
        $checkTrx = Transaction::where('ebook_id', $ebook->id)->where('user_id', Auth::user()->id)->first();
    
        if ($checkTrx) {
            // Jika transaksi valid, tampilkan halaman baca eBook
            return view('member.ebook', compact('ebook', 'checkReview'));
        } else {
            // Jika tidak ada transaksi, tampilkan pesan error dan arahkan ke halaman index eBook
            Alert::error('error', 'Maaf Akses Akses Ditolak, Karena Anda Belum Berlangganan');
            return redirect()->route('member.ebook.index', $slug);
        }
    }
    
    public function detail($slug)
    {
        // Mencari eBook berdasarkan slug yang diberikan
        $ebooks = Ebook::where('slug', $slug)->first();
    
        // Mengambil semua review terkait eBook, termasuk data user yang memberikan review
        $reviews = Review::with('user')->where('ebook_id', $ebooks->id)->get();
    
        // Mengambil data mentor (user) yang terkait dengan eBook
        $user = User::where('id', $ebooks->mentor_id)->first();
    
        // Memeriksa apakah user memiliki transaksi yang valid untuk eBook ini
        $checkTrx = Transaction::where('ebook_id', $ebooks->id)->where('user_id', Auth::user()->id)->first();
    
        // Memeriksa apakah user sudah memberikan review untuk eBook ini
        $checkReview = Review::where('user_id', Auth::user()->id)->where('ebook_id', $ebooks->id)->first();
    
        if ($checkTrx) {
            // Jika transaksi valid, tampilkan halaman detail eBook
            return view('member.detail-ebook', compact('ebooks', 'user', 'checkReview', 'reviews', 'checkTrx'));
        } else {
            // Jika tidak ada transaksi, tampilkan pesan error dan arahkan ke halaman join course
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }
    
}