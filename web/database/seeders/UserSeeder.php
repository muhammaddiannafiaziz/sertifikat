<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Pastikan import Model User
use Illuminate\Support\Facades\Hash; // <-- Pastikan import Hash

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin
        User::firstOrCreate(
            ['email' => 'superadmin@uinsaid.ac.id'], // Kunci unik
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Super5a4d3m2i1n'), // Ganti password ini!
                'role' => 'superadmin',
                'email_verified_at' => now(), // Opsional: langsung verifikasi email
            ]
        );

        // 2. Admin Ma'had
        User::firstOrCreate(
            ['email' => 'mahad.aljamiah@uinsaid.ac.id'], // Kunci unik
            [
                'name' => 'Admin Ma\'had',
                'password' => Hash::make('5a4d3m2i1n'), // Ganti password ini!
                'role' => 'adminmahad',
                'email_verified_at' => now(),
            ]
        );

        // 3. Admin Bahasa
        User::firstOrCreate(
            ['email' => 'upt.bahasa@uinsaid.ac.id'], // Kunci unik
            [
                'name' => 'Admin Bahasa',
                'password' => Hash::make('5a4d3m2i1n'), // Ganti password ini!
                'role' => 'adminbahasa',
                'email_verified_at' => now(),
            ]
        );

        // 4. Admin TIPD
        User::firstOrCreate(
            ['email' => 'upt.tipd@uinsaid.ac.id'], // Kunci unik
            [
                'name' => 'Admin TIPD',
                'password' => Hash::make('5a4d3m2i1n'), // Ganti password ini!
                'role' => 'admintipd',
                'email_verified_at' => now(),
            ]
        );
    }
}