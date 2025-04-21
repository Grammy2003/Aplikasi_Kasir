<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // 🔹 Tambahkan ini


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->truncate(); // Clear the table before seeding
        
        DB::table('users')->insert([
            'name' => "Super Admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('Admin123'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
