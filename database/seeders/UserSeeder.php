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
            'email_verified_at' => now(),
            'password' => Hash::make('Merdeka1945#'),
            'role' => 'superadmin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
