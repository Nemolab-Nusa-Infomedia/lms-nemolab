<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon; // Import Carbon for timestamp generation

class EbookSeeder extends Seeder
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

        // Use Faker to generate data
        $faker = Faker::create();
        $numEbooks = 3;

    
        $timestamp = Carbon::now();

        for ($i = 0; $i < $numEbooks; $i++) {
            DB::table('tbl_ebooks')->insert([
                'category' => $categories[array_rand($categories)], 
                'name' => $faker->sentence(7), 
                'slug' => $faker->slug(), 
                'type' => 'free', 
                'status' => $faker->randomElement(['published']), 
                // 'price' => $faker->randomFloat(2, 0, 200),
                'price' => 0,
                'file_ebook' => "contoh.pdf", 
                'level' => $faker->randomElement(['beginner', 'intermediate', 'expert']),
                'description' => $faker->paragraph(), 
                'mentor_id' => 1, 
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        }
    }
}
