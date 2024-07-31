<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Portofolio;

class PortofolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Portofolio::create([
            'portofolio_name' => 'Introduction to Programming',
            'description' => '',
            'link_portofolio' => 'https://www.github.com/vebriannn/nemolab',
            'course_id' => 1,
        ]);
    }
}