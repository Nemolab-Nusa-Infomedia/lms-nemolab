<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Env;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Comments;
use App\Models\Transaction;
use App\Models\CourseTools;
use App\Models\Review;

class MemberCourseController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();

        $addData = [
            'id' => 0,
            'name' => 'All'
        ];

        $newCategory = $category->push((object)$addData);
        $sortedCategory = $newCategory->sortBy('id');

        return view('member.course', compact('sortedCategory'));
    }

    public function join($slug)
    {
        $course = Course::where('slug', $slug)->first();
        // $reviews = Review::where('course_id', $course->id)->get();

        if ($course) {
            $chapters = Chapter::with('lessons')->where('course_id', $course->id)->get();
            $coursetools = Course::with('tools')->findOrFail($course->id);

            if ($chapters->isNotEmpty()) {
                $lesson = Lesson::with('chapters')->where('chapter_id', $chapters->first()->id)->first();
            } else {
                $lesson = null;
            }

            if(Auth::user()){
                $transaction = Transaction::where('user_id', Auth::user()->id)
                ->where('course_id', $course->id)
                ->first();
            }
            else {
                $transaction = null;
            }

            $transactionForEbook = null;
            return view('member.joincourse', compact('chapters', 'course', 'lesson', 'transaction', 'transactionForEbook', 'coursetools'));
        }
        else {
            return view('error.page404');
        }
    }



    public function play($slug, $episode)
    {
        $course = Course::where('slug', $slug)->first();
        $user = User::where('id', $course->mentor_id)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $course->id)->get();
        $play = Lesson::where('episode', $episode)->first();
        $checkTrx = Transaction::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();

        $checkReview = Review::where('user_id', Auth::user()->id)->first();

        if($checkTrx) {
            return view('member.play', compact('play', 'chapters', 'slug', 'course', 'user', 'checkReview'));
        }
        else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }
}
