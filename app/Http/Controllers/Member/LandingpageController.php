<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\CourseEbook;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LandingpageController extends Controller
{
    public function index()
    {
        // Check if user is logged in
        if (Auth::check()) {
            $userProfession = Auth::user()->profession;
            $lastMonth = Carbon::now()->subMonth();
            $lastYear = Carbon::now()->subYear();

            // Get courses matching user's profession as category
            $courses = Course::with('users')
                ->where('status', 'published')
                ->where('category', $userProfession)
                ->latest()
                ->take(10)
                ->get();

            // If no courses found for user's profession, fall back to random courses
            if ($courses->isEmpty()) {
                $courses = Course::with('users')
                    ->where('status', 'published')
                    ->where('created_at', '>=', $lastMonth)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();

                if ($courses->count() < 10) {
                    $courses = Course::with('users')
                        ->where('status', 'published')
                        ->where('created_at', '>=', $lastYear)
                        ->inRandomOrder()
                        ->take(10)
                        ->get();
                }
            }
        } else {
            // Get 10 random courses from the last week for non-logged in users
            
            $lastMonth = Carbon::now()->subMonth();
            $lastYear = Carbon::now()->subYear();
            
            $courses = Course::with('users')
                ->where('status', 'published')
                ->where('created_at', '>=', $lastMonth)
                ->inRandomOrder()
                ->take(10)
                ->get();

            // If less than 10 courses found in last week, get random courses without date restriction
            if ($courses->count() < 10) {
                $courses = Course::with('users')
                    ->where('status', 'published')
                    ->where('created_at', '>=', $lastYear)
                    ->inRandomOrder()
                    ->take(10)
                    ->get();
            }
        }

        // Get course IDs included in bundles
        $InBundle = CourseEbook::pluck('course_id')->toArray();
    
        return view('member.home', compact('courses', 'InBundle'));
    }    
}