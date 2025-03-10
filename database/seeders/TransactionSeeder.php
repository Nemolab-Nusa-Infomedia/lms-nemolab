<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     Transaction::create([
    //         'course_id' => 1,
    //         'user_id' => 2,
    //         'status' => 'pending'
    //     ]);

    //     // $faker = Faker::create();

    //     // // Menambahkan 50 transaksi contoh
    //     // foreach (range(1, 50) as $index) {
    //     //     Transaction::create([
    //     //         'course_id' => $faker->numberBetween(1, 20), // Asumsi ada 20 kursus di database
    //     //         'user_id' => $faker->numberBetween(1, 10), // Asumsi ada 10 pengguna di database
    //     //         'status' => $faker->randomElement(['success', 'pending', 'failed']),
    //     //     ]);
    //     // }
    // }
}