<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Course;
use App\Models\Ebook;
use App\Models\Transaction;
use App\Models\Submission;
use App\Models\MyListCourse;
use App\Models\Chapter;
use App\Models\CompleteEpisodeCourse;

class MemberMyCourseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $lastBookId = $request->input('lastBookId') == 'null' ? null : $request->input('lastBookId');
            $lastCourseId = $request->input('lastCourseId') == "null" ? null : $request->input('lastCourseId');

            $filter = $request->input('filter') == "null" ? null : $request->input('filter');

            $itemsPerRow = $request->input('itemsPerRow') == false ? 1 : $request->input('itemsPerRow');
            $rowsToLoad = 10;
            $perLoad = $itemsPerRow * $rowsToLoad;

            $courseQuery = MyListCourse::where('user_id', Auth::user()->id)->whereNotNull('course_id')->orderByDesc('id')->limit($perLoad);

            $ebookQuery = MyListCourse::where('user_id', Auth::user()->id)->whereNotNull('ebook_id')->orderByDesc('id')->limit($perLoad);

            if ($lastCourseId != null) {
                $courseQuery->where('id', '<', $lastCourseId);
            }
            if ($lastBookId != null) {
                $ebookQuery->where('id', '<', $lastBookId);
            }

            $courseIds = $courseQuery->get('course_id');

            $ebookIds = $ebookQuery->get('ebook_id');
            // return response()->json( $perLoad);

            $coursesQuery = Course::whereIn('id', $courseIds)->with('mylist')->orderBy('id', 'DESC');
            $ebooksQuery = Ebook::whereIn('id', $ebookIds)->with('mylist')->orderBy('id', 'DESC');

            switch ($filter) {
                case 'kursus':
                    $courses = $coursesQuery->get();
                    $ebooks = collect();
                    break;
                case 'ebook':
                    $courses = collect();
                    $ebooks = $ebooksQuery->get();
                    break;
                default:
                    $courses = $coursesQuery->get();
                    $ebooks = $ebooksQuery->get();
                    break;
            }

            $coursesData = $courses->map(function ($course) {
                $totalLessons = Chapter::where('course_id', $course->id)
                    ->withCount('lessons')
                    ->get()
                    ->sum('lessons_count');
                $lessonProgress = CompleteEpisodeCourse::where('user_id', Auth::user()->id)
                    ->where('course_id', $course->id)
                    ->count();
                $course->total_lesson = $totalLessons;
                $course->lesson_progress = $lessonProgress;
                $course->status = ($lessonProgress == $totalLessons) ? 'Selesai' : 'Belum Selesai';
                $course->transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('course_id', $course->id)
                    ->first();

                return $course;
            });
            $ebooksData = $ebooks->map(function ($ebook) {
                $ebook->transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('ebook_id', $ebook->id)
                    ->first();
                return $ebook;
            });

            $merged = $ebooks->concat($courses)->sortByDesc(function ($item) {
                return $item->mylist[0]->id;
            })->take($perLoad);

            // Set data terakhir dari tiap tipe
            $lastCourse = $merged->where('product_type', 'video')->last();
            $lastEbook = $merged->where('product_type', 'ebook')->last();

            // Ambil Id terakhir sebagai check point
            if (isset($lastCourse->id)) $lastCourseId = $lastCourse->mylist[0]->id;
            if (isset($lastEbook->id)) $lastBookId =  $lastEbook->mylist[0]->id;

            $total_course = Transaction::where('user_id', Auth::user()->id)
                ->where('status', 'success')
                ->count();
            $submission = Submission::where('user_id', Auth::user()->id)->first();

            return response()->json([
                'data' => $merged != null ? $merged->values()->all() : $merged,
                'total_course' => $total_course,
                'hasMore' => $merged->count() >= $perLoad,
                'lastBookId' => $lastBookId,
                'lastCourseId' => $lastCourseId,
            ]);
        }
        return view(
            'member.dashboard.mycourse'
            // , compact('coursesData', 'ebooksData', 'submission', 'total_course')
        );
    }



    public function reqMentor(Request $requests, $id)
    {

        $user = Submission::where('user_id', $id)->first();

        if (!$user) {
            Submission::create([
                'status' => 'pending',
                'user_id' => $id
            ]);
        }

        Alert::success('success', 'Pengajuan Berhasil Di Kirim, Mohon Tunggu Sampai Admin Konfirmasi');
        return redirect()->route('member.dashboard');
    }
}
