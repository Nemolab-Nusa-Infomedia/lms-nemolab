<?php

namespace App\Http\Controllers\member;

use App\Models\User;
use App\Models\Ebook;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Review;
use App\Models\Chapter;



use App\Models\CourseEbook;
use App\Models\Transaction;
use App\Models\MyListCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CompleteEpisodeCourse;
use RealRashid\SweetAlert\Facades\Alert;

class MemberCourseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $lastBookId = $request->input('lastBookId') == 'null' ? null : explode(',', $request->input('lastBookId'));
            $lastCourseId = $request->input('lastCourseId') == "null" ? null : $request->input('lastCourseId');
            $searchQuery = $request->input('search-input') == "null" ? null : $request->input('search-input');
            $categoryFilter = $request->input('filter-kelas') == "null" ? null : $request->input('filter-kelas');
            $paketFilter = $request->input('filter-paket') == "null" ? null : $request->input('filter-paket');
            $itemsPerRow = $request->input('requestTotal') == "null" ? null : $request->input('requestTotal');
            // New filter parameters
            $sort = $request->input('sort', 'new');
            $level = $request->input('level', 'all');
            $type = $request->input('type', 'all');
            $year = $request->input('year', date('Y'));
            
            $rowsToLoad = 10;
            $perLoad = $itemsPerRow * $rowsToLoad;

            // Base queries
            $coursesQuery = Course::where('status', 'published');
            $ebooksQuery = Ebook::where('status', 'published');

            // Apply sort filter
            switch($sort) {
                case 'popular':
                    $coursesQuery->withCount(['transactions' => function($query) {
                        $query->where('status', 'success');
                    }])
                    ->select('tbl_courses.*')
                    ->orderByDesc('transactions_count')
                    ->orderByDesc('id');
                
                    $ebooksQuery->withCount(['transactions' => function($query) {
                        $query->where('status', 'success');
                    }])
                    ->select('tbl_ebooks.*')
                    ->orderByDesc('transactions_count')
                    ->orderByDesc('id');
                    break;
                case 'price_low':
                    $coursesQuery->where(function($query) {
                        $query->whereDoesntHave('courseEbooks')
                            ->orWhereHas('courseEbooks', function($q) {
                                $q->orderBy('price');
                            });
                    })->orderBy('price');
                    
                    $ebooksQuery->where(function($query) {
                        $query->whereDoesntHave('courseEbooks')
                            ->orderBy('price');
                    });
                    break;
                case 'price_high':
                    $coursesQuery->where(function($query) {
                        $query->whereDoesntHave('courseEbooks')
                            ->orWhereHas('courseEbooks', function($q) {
                                $q->orderByDesc('price');
                            });
                    })->orderByDesc('price');
                    
                    $ebooksQuery->where(function($query) {
                        $query->whereDoesntHave('courseEbooks')
                            ->orderByDesc('price');
                    });
                        break;
                default: // 'new'
                    $coursesQuery->orderByDesc('id');
                    $ebooksQuery->orderByDesc('id');
            }

            // Apply level filter
            if ($level !== 'all') {
                $coursesQuery->where('level', $level);
                $ebooksQuery->where('level', $level);
            }

            // Apply type filter
            if ($type === 'starter') {
                $coursesQuery->where('type', 'free');
                $ebooksQuery->where('type', 'free');
            } elseif ($type === 'premium') {
                $coursesQuery->where('type', 'premium');
                $ebooksQuery->where('type', 'premium');
            }

            // Apply year filter
            $coursesQuery->whereYear('created_at', $year);
            $ebooksQuery->whereYear('created_at', $year);

            // Menerapkan filter pencarian
            if ($searchQuery) {
                $coursesQuery->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhereHas('users', function ($q) use ($searchQuery) {
                            $q->where('name', 'LIKE', '%' . $searchQuery . '%');
                        });
                });
                $ebooksQuery->where(function ($query) use ($searchQuery) {
                    $query->where('name', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                        ->orWhereHas('users', function ($q) use ($searchQuery) {
                            $q->where('name', 'LIKE', '%' . $searchQuery . '%');
                        });
                });
            }

            // Menerapkan filter kategori
            if ($categoryFilter && $categoryFilter != 'semua') {
                $coursesQuery->where('category', $categoryFilter);
                $ebooksQuery->where('category', $categoryFilter);
            }

            // Menerapkan filter paket
            switch ($paketFilter) {
                case 'paket-kursus':
                    $coursesQuery->whereDoesntHave('courseEbooks');
                    $ebooksQuery = null;
                    break;
                case 'paket-ebook':
                    $ebooksQuery->whereDoesntHave('courseEbooks');
                    $coursesQuery = null;
                    break;
                case 'paket-bundling':
                    $coursesQuery->whereHas('courseEbooks');
                    $ebooksQuery = null;
                    break;
                default:
                    $ebooksQuery->whereDoesntHave('courseEbooks');
                    break;
            }

            // Mengambil data courses dan ebooks
            $courses = $coursesQuery ? $coursesQuery->with('users', 'courseEbooks')
            ->select([
                'tbl_courses.id',
                'tbl_courses.mentor_id',
                'tbl_courses.cover',
                'tbl_courses.name',
                'tbl_courses.category',
                'tbl_courses.slug',
                'tbl_courses.created_at',
                'tbl_courses.product_type',
                'tbl_courses.price'
            ])
            ->when($sort === 'popular', function($query) {
                return $query->addSelect(DB::raw('(SELECT COUNT(*) FROM tbl_transactions WHERE tbl_transactions.course_id = tbl_courses.id AND status = "success") as transactions_count'));
            })
            ->limit($perLoad)
            ->when($sort === 'popular', function($query) {
                return $query->orderByDesc('transactions_count');
            })
            ->get() : collect();

        $ebooks = $ebooksQuery ? $ebooksQuery->with('users')
            ->select([
                'tbl_ebooks.id',
                'tbl_ebooks.mentor_id',
                'tbl_ebooks.cover',
                'tbl_ebooks.name',
                'tbl_ebooks.category',
                'tbl_ebooks.slug',
                'tbl_ebooks.created_at',
                'tbl_ebooks.product_type',
                'tbl_ebooks.price'
            ])
            ->when($sort === 'popular', function($query) {
                return $query->addSelect(DB::raw('(SELECT COUNT(*) FROM tbl_transactions WHERE tbl_transactions.ebook_id = tbl_ebooks.id AND status = "success") as transactions_count'));
            })
            ->limit($perLoad)
            ->when($sort === 'popular', function($query) {
                return $query->orderByDesc('transactions_count');
            })
            ->get() : collect();

            // Mengambil data bundling
            $bundling = CourseEbook::whereIn('course_id', $courses->pluck('id'))
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->course_id => $item];
                }); 

            // Menggabungkan data
            $merged = $ebooks->concat($courses);

            // Urutkan berdasarkan harga jika diperlukan
            if ($sort === 'price_low' || $sort === 'price_high') {
                $merged = $merged->sortBy(function ($item) use ($bundling) {
                    if ($item->product_type === 'video' && isset($bundling[$item->id])) {
                        return $bundling[$item->id]->price;
                    }
                    return $item->price;
                }, SORT_REGULAR, $sort === 'price_high');
            } elseif ($sort === 'popular') {
                $merged = $merged->sortByDesc(function ($item) {
                    return Transaction::where(function ($query) use ($item) {
                        if ($item->product_type === 'video') {
                            $query->where(function ($q) use ($item) {
                                $q->where('course_id', $item->id)
                                    ->orWhereHas('bundle', function($b) use ($item) {
                                        $b->where('course_id', $item->id);
                                    });
                            });
                        } else {
                            $query->where(function ($q) use ($item) {
                                $q->where('ebook_id', $item->id)
                                    ->orWhereHas('bundle', function($b) use ($item) {
                                        $b->where('ebook_id', $item->id);
                                    });
                            });
                        }
                    })
                    ->where('status', 'success')
                    ->count();
                })->values();
            } else {
                $merged = $merged->sortByDesc('created_at');
            }

            $merged = $merged->take($perLoad);

            // Menentukan apakah masih ada data yang bisa di-load
            $hasMore = $merged->count() >= $perLoad;
            if ($merged->count() <= 0) {
                $merged = null;
            }

            // Set data terakhir dari tiap tipe
            $lastCourse = $merged->where('product_type', 'video')->last();
            $lastEbook = $merged->where('product_type', 'ebook')->last();

            // Ambil Id terakhir sebagai check point
            if(isset($lastCourse->id)) $lastCourseId = $lastCourse->id;
            if(isset( $lastEbook->id)) $lastBookId =  $lastEbook->id;

            // Mengembalikan respons JSON
            return response()->json([
                'data' => $merged != null ? $merged->values()->all() : $merged, // Convert collection to array
                'bundling' => $bundling,
                'hasMore' => $hasMore,
                'lastBookId' => $lastBookId,
                'lastCourseId' => $lastCourseId,
            ]);
        }

        // For initial page load, pass default values
        $currentYear = date('Y');
        $yearOptions = range($currentYear, $currentYear - 4);
        
        return view('member.course', compact('yearOptions', 'currentYear'));
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


            return view('member.joincourse', compact('chapters', 'chapterInfo', 'courses', 'lesson', 'transaction', 'transactionForEbook', 'coursetools', 'reviews', 'bundling'));
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
            return redirect()->route('member.course.join', $slug)->with('alert', ['type' => 'error', 'message' => 'Maaf Tidak Bisa Akses, Karena Anda Belum Beli Kelas ini!!!']);
        }
    }



    public function detail($slug)
    {
        // Mencari data kursus berdasarkan slug yang diberikan
        $courses = Course::where('slug', $slug)->first();
        // Mengambil (review) untuk kursus yang ditemukan, beserta data pengguna yang memberi ulasan
        $reviews = Review::with('user')->where('course_id', $courses->id)->get();
        // Mengambil data mentor (user) yang terkait dengan kursus
        $user = User::where('id', $courses->mentor_id)->first();
        // Mengambil bab-bab (chapters) dan pelajaran (lessons) yang terkait dengan kursus
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        // Memeriksa apakah transaksi untuk kursus tersebut sudah ada untuk pengguna yang sedang login
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();
        // Memeriksa apakah pengguna sudah memberikan ulasan untuk kursus ini
        $checkReview = Review::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->first();
        // Mengambil data alat (tools) yang terkait dengan kursus
        $coursetools = Course::with('tools')->findOrFail($courses->id);
        // Memeriksa episode lengkap yang sudah diikuti oleh pengguna untuk kursus ini
        $compeleteEps = CompleteEpisodeCourse::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->get();
        // Mengambil data bundling yang terdiri dari kursus dan ebook yang terkait
        $bundling = CourseEbook::with(['course', 'ebook'])
            ->where('course_id', $courses->id)
            ->first();
        // Mengambil informasi bab terakhir berdasarkan waktu pembuatan (terbaru)
        $chapterInfo = Chapter::where('course_id', $courses->id)
            ->orderBy('created_at', 'desc')
            ->first();
        // Menghitung total jumlah pelajaran dari semua bab
        $totalLesson = 0;
        foreach ($chapters as $chapter) {
            $totalLesson += $chapter->lessons->count();
        }
        // Memeriksa apakah sertifikat sudah dapat diberikan (seluruh pelajaran telah diselesaikan)
        $checkSertifikat = false;
        if ($totalLesson == $compeleteEps->count()) {
            $checkSertifikat = true;
        }
        // Jika transaksi ditemukan, tampilkan halaman detail kursus
        if ($checkTrx) {
            return view('member.detail-course', compact('chapterInfo', 'bundling', 'chapters', 'slug', 'courses', 'user', 'checkReview', 'coursetools', 'reviews', 'checkSertifikat'));
        } else {
            // Jika tidak ada transaksi, tampilkan pesan error dan arahkan ke halaman bergabung dengan kursus
            return redirect()->route('member.course.join', $slug)->with('alert', ['type' => 'error', 'message' => 'Maaf Tidak Bisa Akses, Karena Anda Belum Beli Kelas ini!!!']);
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
