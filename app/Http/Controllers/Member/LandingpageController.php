<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\CourseEbook;


class LandingpageController extends Controller
{
    public function index()
    {
        // Mengambil data kursus yang memiliki status 'published'
        // Data kursus juga dimuat dengan relasi 'users
        // Data kursus dipilih secara acak menggunakan inRandomOrder() dan dibatasi sebanyak 8 kursus
        $courses = Course::with('users')->where('status', 'published')
            ->inRandomOrder() // Pilih secara acak
            ->take(8)          // Batasi hasilnya menjadi 8 kursus
            ->get();
        // Mengambil semua ID kursus yang termasuk dalam bundle
        $InBundle = CourseEbook::pluck('course_id')->toArray();
    
        // Mengirimkan data kursus dan ID bundle ke view 'member.home'
        return view('member.home', compact('courses', 'InBundle'));
    }    
}
