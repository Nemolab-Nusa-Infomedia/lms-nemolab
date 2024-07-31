<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lesson::create([
            'name' => 'tools yang akan di gunakan',
            'video' => 'https:://gedangsuket.id/video',
            'chapter_id' => 1,
        ]);
    }
}