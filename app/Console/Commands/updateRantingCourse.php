<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Review;
use App\Models\Course;

class updateRantingCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:ranting-course';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated Ranting';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reviews = Review::all();
        $courses = Course::all();

        foreach ($courses as $course) {
            $course_reviews = $reviews->where('course_id', $course->id);
            $review_count = $course_reviews->count();

            if ($review_count > 0) {
                $total_rating = $course_reviews->sum('rating');
                $average_rating = $total_rating / $review_count;

                if ($average_rating - floor($average_rating) < 0.5) {
                    $rounded_rating = floor($average_rating);
                } else {

                    $rounded_rating = ceil($average_rating);
                }

                $course->rating = $rounded_rating;
            } else {
                $course->rating = 0;
            }

            $course->save();
        }
    }
}
