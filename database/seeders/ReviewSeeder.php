<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_reviews')->insert([
            [
                'user_id' => 1, // Change this to a valid user_id
                'course_id' => 1, // Change this to a valid course_id
                'rating' => 5,
                'note' => 'Excellent course!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Change this to a valid user_id
                'course_id' => 1, // Change this to a valid course_id
                'rating' => 4,
                'note' => 'Very good course.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3, // Change this to a valid user_id
                'course_id' => 2, // Change this to a valid course_id
                'rating' => 3,
                'note' => 'Good, but could be improved.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
