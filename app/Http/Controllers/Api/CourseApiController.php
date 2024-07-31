<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Models\Course;
Use App\Models\User;
use App\Models\Chapter;
use App\Http\Resources\Api\ApiCourseResource;
use App\Http\Resources\Api\ApiChapterResource;

class CourseApiController extends Controller
{
    public function course(Request $requests) {
        $q = $requests->query('q');
        
        if($q != "all") {
            $course = User::with(['courses' => function ($query) use ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%');
                $query->where('status', 'published');
            }])->get();
        }
        else {
            $course = User::with(['courses' => function ($query) use ($q) {
                $query->where('status', 'published');
            }])->get();
        }
        
        // filter course, jika mentor tidak ada course yang di buat maka akan di hapus
        $filteredCourse = $course->filter(function ($filter) {
            return $filter->courses->isNotEmpty();
        });
        
        return ApiCourseResource::collection($filteredCourse);
    }

    public function chapter(Request $requests) {
        $id = $requests->query('id');
        
        $chapter = Chapter::with('lessons')->get();
        return ApiChapterResource::collection($chapter);
    }
}