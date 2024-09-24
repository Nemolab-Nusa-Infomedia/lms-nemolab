<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Category = [
            ['name' => 'Frontend Developer'],
            ['name' => 'Backend Developer' ],
            ['name' => 'FullStack Developer'],
            ['name' => 'UI UX Designer'],
            ['name' => 'Mobile Developer'],
        ];

        for ($i = 0; $i < count($Category); $i++) {
            Category::create($Category[$i]);
        }
    }
}