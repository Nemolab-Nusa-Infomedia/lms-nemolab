<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

Use App\Models\User;
use App\Models\Chapter;
use App\Models\Category;
use App\Http\Resources\Api\ApiCourseResource;
use App\Http\Resources\Api\ApiChapterResource;
use App\Http\Resources\Api\ApiCategoryResource;

class CourseApiController extends Controller
{
    public function course(Request $requests) {
        $q = $requests->query('q');
        
        $course = User::with(['courses' => function ($query) use ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
            $query->where('status', 'published')
            ->OrderBy('id', 'DESC');
        }])->get();

        // filter course, jika mentor tidak ada course yang di buat maka akan di hapus
        $filteredCourse = $course->filter(function ($filter) {
            return $filter->courses->isNotEmpty();
        });

        
        if($filteredCourse->isEmpty()) {
            return response()->json([
                'data' => [
                    'course' => [],
                    'message' => 'notfound'
                ],
            ]);
        }
        else {
            return ApiCourseResource::collection($filteredCourse);
        }
        
    }

    public function filterCourseCategory(Request $requests) {
        $q = Str::lower($requests->query('q'));
        
        if($q != "all") {
            $course = User::with(['courses' => function ($query) use ($q) {
                $query->where('category', $q);
                $query->where('status', 'published')
                ->OrderBy('id', 'DESC');
            }])->get();
        }
        else {
            $course = User::with(['courses' => function ($query) use ($q) {
                $query->where('status', 'published')
                ->OrderBy('id', 'DESC');
            }])->get();
        }

        // filter course, jika mentor tidak ada course yang di buat maka akan di hapus
        $filteredCourse = $course->filter(function ($filter) {
            return $filter->courses->isNotEmpty();
        });

        if($filteredCourse->isEmpty()) {
            return response()->json([
                'data' => [
                    'course' => [],
                    'message' => 'notfound'
                ],
            ]);
        }
        else {
            return ApiCourseResource::collection($filteredCourse);
        }

    }

    public function chapter(Request $requests) {
        $id = $requests->query('id');
        
        $chapter = Chapter::with('lessons')->get();
        return ApiChapterResource::collection($chapter);
    }

    public function category() {
        $category = Category::all();

        $addData = [
            'id' => 0,
            'name' => 'All' 
        ];
        
        $newCategory = $category->push((object)$addData);
        $sortedCategory = $newCategory->sortBy('id');
        
        return ApiCategoryResource::collection($sortedCategory);
    }
}