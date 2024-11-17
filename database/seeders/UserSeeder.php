<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seed 20 users
        DB::table('users')->insert([
            'name' => 'superadmin',
            // 'avatar' => 'default.png',
            'email' => 'superadmin@nemolab.com',
            'password' => Hash::make('password123'),
            'role' => 'superadmin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}