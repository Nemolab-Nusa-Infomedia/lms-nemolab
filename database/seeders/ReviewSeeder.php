<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $reviews = [];

        for ($i = 0; $i < 10; $i++) {
            $reviews[] = [
                'user_id' => 1, 
                // 'course_id' => 0,
                'ebook_id' => 1, 
                'note' => $faker->sentence(10), 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // for ($i = 0; $i < 10; $i++) {
        //     $reviews[] = [
        //         'user_id' => 1, 
        //         'course_id' => 1,
        //         'ebook_id' => 0, 
        //         'note' => $faker->sentence(10), 
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        DB::table('tbl_reviews')->insert($reviews);
    }
}
