<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;



use App\Models\Ebook;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\CourseEbook;
use App\Models\CompleteEpisodeCourse;
use App\Models\MyListCourse;

class MemberCourseController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input filter
        $searchQuery = $request->input('search-input'); 
        $categoryFilter = $request->input('filter-kelas');
        $paketFilter = $request->input('filter-paket');
        $perPage = 9; //jumlah data tampil pada per 1 halaman
    
        // Membuat query dasar untuk mengambil data kursus hanya saat status "published"
        $coursesQuery = Course::where('status', 'published');
    
        // Membuat query dasar untuk mengambil data ebook hanya saat status "published"
        $ebooksQuery = Ebook::where('status', 'published');
    
        // jalankan logika ini saat ada input dari pencarian
        if ($searchQuery) {
            $coursesQuery->where(function ($query) use ($searchQuery) {
                $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhereHas('users', function ($q) use ($searchQuery) {
                        // Filter berdasarkan nama mentor
                        $q->where('name', 'LIKE', '%' . $searchQuery . '%');
                    });
            });
            $ebooksQuery->where(function ($query) use ($searchQuery) {
                $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                    ->orWhereHas('users', function ($q) use ($searchQuery) {
                        // Filter berdasarkan nama mentor
                        $q->where('name', 'LIKE', '%' . $searchQuery . '%');
                    });
            });
        }
    
        // Jalankan logika ini saat ada input dari filter category dan menghindari nilai 'semua' karena 'semua' bukan termasuk category
        if ($categoryFilter && $categoryFilter != 'semua') {
            $coursesQuery->where('category', $categoryFilter);
            $ebooksQuery->where('category', $categoryFilter);
        }
    
        // Filter paket berdasarkan pilihan pengguna
        switch ($paketFilter) {
            case 'paket-kursus':
                // Jika paket yang dipilih adalah paket kursus, ambil hanya data kursus
                $coursesQuery->whereDoesntHave('courseEbooks');
                $ebooksQuery = null; // Jangan ambil data ebook
                break;
    
            case 'paket-ebook':
                // Jika paket yang dipilih adalah paket ebook, ambil hanya data ebook
                $ebooksQuery->whereDoesntHave('courseEbooks');
                $coursesQuery = null; // Jangan ambil data kursus
                break;
    
            case 'paket-bundling':
                // Jika paket yang dipilih adalah paket bundling, ambil data kursus yang memiliki bundling
                $coursesQuery->whereHas('courseEbooks');
                $ebooksQuery = null; // Jangan ambil data ebook
                break;
    
            default:
                // kondisi default/pada saat filter diluar case. maka hanya terapkan pengaturan saat ebook tidak termasuk bundling
                $ebooksQuery->whereDoesntHave('courseEbooks');
                break;
        }
    
        // ambil data course saat coursesQuery tidak null dan menyimpanya pada memory dengan collection
        $courses = $coursesQuery ? $coursesQuery->with('users', 'courseEbooks')
            ->select('id', 'mentor_id', 'cover', 'name', 'category', 'slug', 'created_at', 'product_type', 'price')->get() : collect();
        // ambil data ebook saat ebooksQuery tidak null dan menyimpanya pada memory dengan collection
        $ebooks = $ebooksQuery ? $ebooksQuery->with('users')
            ->select('id', 'mentor_id', 'cover', 'name', 'category', 'slug', 'created_at', 'product_type', 'price')->get() : collect();
        
        //Menggabungkan data kursus dan ebook, lalu mengurutkan berdasarkan waktu terbaru rilis,
        //menggunakan concat untuk menggabungkan 2 collection($ebooks dan $courses) menjadi 1,
        //dan pada saat ada id yang sama pada kedua collection maka data tersebut menjadi entri terpisah dan tidak menimpa(menghindari hanya menampilkan 1 data saat 2 id sama)
        $merged = $courses->concat($ebooks)->sortByDesc('created_at');
    
        // Mengatur pagination secara manual menggunakan LengthAwarePaginator karena data berasal dari collection
        $page = $request->input('page', 1);
        $paginatedData = new LengthAwarePaginator(
            $merged->forPage($page, $perPage), // Mengambil data sesuai halaman
            $merged->count(), // Total data yang akan dipaginasi
            $perPage, // Jumlah data per halaman
            $page, // Halaman saat ini
            ['path' => $request->url(), 'query' => $request->query()] // URL dan query parameter untuk pagination
        );
    
        // Mengambil data bundling yang terkait dengan kursus
        $bundling = CourseEbook::whereIn('course_id', $courses->pluck('id'))->get()->mapWithKeys(function ($item) {
            return [$item->course_id => $item];
        });
        // Mengembalikan tampilan dengan data yang sudah diproses
        return view('member.course', [
            'data' => $paginatedData, // Data yang sudah dipaginasi
            'paketFilter' => $paketFilter, // Filter paket yang dipilih
            'bundling' => $bundling, // Data bundling yang terkait
        ]);
    }
    


    public function join($slug)
    {
        // Mencari data kursus berdasarkan slug terlebih dahulu
        $courses = Course::where('slug', $slug)->first();
    
        // Logika ketika kursus ditemukan
        if ($courses) {
            // Mengambil data chapter dan lessons yang cocok dengan course
            $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
    
            // Mengambil data reviews yang cocok dengan course
            $reviews = Review::with('user')->where('course_id', $courses->id)->get();
    
            // Mengecek apakah kursus memiliki bundling dengan eBook yang terisi
            $bundling = CourseEbook::with(['course', 'ebook'])
                ->where('course_id', $courses->id)
                ->first();
    
            // Ketika data chapter ada/tidak null maka tampilkan lesson pertama
            $lesson = $chapters->isNotEmpty()
                ? Lesson::with('chapters')->where('chapter_id', $chapters->first()->id)->first()
                : null;
    
            // Mengecek apakah ada transaksi course pada user
            $transaction = Auth::check()
                ? Transaction::where('user_id', Auth::id())
                    ->where('course_id', $courses->id)
                    ->orderBy('created_at', 'desc') // cek dari transaksi terbaru
                    ->first()
                : null;
            // Mendapatkan data tools yang ada pada course
            $coursetools = Course::with('tools')->findOrFail($courses->id);
            // Placeholder untuk transaksi eBook (jika diperlukan logika tambahan)
            $transactionForEbook = null;
            $chapterInfo = Chapter::where('course_id', $courses->id)
            ->orderBy('created_at', 'desc') 
            ->first();


            return view('member.joincourse', compact('chapters', 'chapterInfo','courses', 'lesson', 'transaction', 'transactionForEbook', 'coursetools', 'reviews', 'bundling'));
        } else {
            // Jika kursus tidak ditemukan, redirect ke halaman error
            return redirect()->route('pages.error');
        }
    }
    



    public function play($slug, $episode)
    {
        // Mengambil data kursus berdasarkan slug
        $courses = Course::where('slug', $slug)->first();
        // Mengambil data mentor berdasarkan mentor_id dari kursus
        // $user = User::where('id', $courses->mentor_id)->first();

        // Mengambil semua chapter dan lesson terkait kursus
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();

        // Mengambil data lesson berdasarkan episode
        $play = Lesson::where('episode', $episode)->first();

        // Memeriksa apakah user yang login telah melakukan transaksi untuk kursus ini
        $checkTrx = Transaction::where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Memeriksa apakah kursus ini memiliki bundling dengan eBook
        $paketKelas = CourseEbook::where('course_id', $courses->id)->first();

        // Memeriksa apakah user sudah memberikan review untuk kursus ini
        $checkReview = Review::where('user_id', Auth::user()->id)->first();

        // Memeriksa apakah episode yang sedang diputar sudah ditandai sebagai selesai
        $checkCompelete = CompleteEpisodeCourse::where('episode_id', $play->id)
            ->where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Jika episode belum ditandai selesai, maka buat data baru di tabel CompleteEpisodeCourse
        if (!$checkCompelete) {
            CompleteEpisodeCourse::create([
                'user_id' => Auth::user()->id,
                'course_id' =>  $courses->id,
                'episode_id' => $play->id
            ]);
        }

        // Mendapatkan daftar episode yang telah selesai untuk user ini di kursus terkait
        $epComplete = CompleteEpisodeCourse::where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->pluck('episode_id') // Hanya mengambil ID episode yang selesai
            ->toArray();

        // Memeriksa apakah user memiliki transaksi untuk kursus ini
        if ($checkTrx) {
            // Jika transaksi ditemukan, tampilkan halaman play dengan data terkait
            return view('member.play', compact('play', 'chapters', 'slug', 'courses', 'checkReview', 'paketKelas', 'epComplete'));
        } else {
            // Jika tidak ada transaksi, tampilkan pesan error dan arahkan kembali ke halaman join
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }



    public function detail($slug)
    {
        $courses = Course::where('slug', $slug)->first();
        $reviews = Review::with('user')->where('course_id', $courses->id)->get();
        $user = User::where('id', $courses->mentor_id)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();
        $checkReview = Review::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->first();
        $coursetools = Course::with('tools')->findOrFail($courses->id);
        $compeleteEps = CompleteEpisodeCourse::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->get();
        $bundling = CourseEbook::with(['course', 'ebook'])
        ->where('course_id', $courses->id)
        ->first();
        $chapterInfo = Chapter::where('course_id', $courses->id)
                              ->orderBy('created_at', 'desc') 
                              ->first();

        $totalLesson = 0;
        foreach ($chapters as $chapter) {
            $totalLesson += $chapter->lessons->count();
        }

        $checkSertifikat = false;
        if ($totalLesson == $compeleteEps->count()) {
            $checkSertifikat = true;
        }


        if ($checkTrx) {
            return view('member.detail-course', compact('chapterInfo','bundling','chapters', 'slug', 'courses', 'user', 'checkReview', 'coursetools', 'reviews', 'checkSertifikat'));
        } else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }


    public function generateSertifikat($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $checkCourse = MyListCourse::where('course_id', $course->id);
        if ($checkCourse) {

            // Data dinamis
            $data = [
                'name' => Auth::user()->name,
                'course' =>  $course->category . ' : ' . $course->name,
                'date' => \Carbon\Carbon::now()->format('d F Y')
            ];

            $pdf = Pdf::loadView('sertifikat.view', $data)->setPaper('A4', 'landscape');

            return $pdf->download('sertifikat-' . Auth::user()->name . '.pdf');
        }
        return redirect()->back();
    }
}