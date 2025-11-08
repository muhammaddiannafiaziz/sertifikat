<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil UserSeeder baru Anda di sini
        $this->call([
            UserSeeder::class,
            // Anda bisa tambahkan seeder lain di sini nanti
        ]);
    }
}