<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // List of categories
        $categories = [
            'Frontend Developer', 
            'Backend Developer', 
            'Wordpress Developer',
            'Graphics Designer',
            'Fullstack Developer',
            'UI/UX Designer'
        ];

        
        $faker = Faker::create();
        $timestamp = Carbon::now();
        
        $numCourses = 8; 
        for ($i = 0; $i < $numCourses; $i++) {
            DB::table('tbl_courses')->insert([
                'category' => $categories[array_rand($categories)],
                'name' => $faker->sentence(7), 
                'slug' => $faker->slug(), 
                'type' => 'premium', 
                'status' => $faker->randomElement(['published']),
                // 'price' => 0,
                'price' => 2000,
                'level' => $faker->randomElement(['beginner', 'intermediate', 'expert']), 
                'description' => $faker->paragraph(), 
                'resources' => $faker->url(),
                'link_grub' => $faker->url(),
                'mentor_id' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        }
    }
}
