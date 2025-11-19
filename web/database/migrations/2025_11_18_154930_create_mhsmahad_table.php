<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mhsmahad', function (Blueprint $table) {
            $table->id();
            // Relasi ke 'nim' di tabel master 'mahasiswas'
            // Pastikan 'nim' di tabel 'mahasiswas' adalah UNIQUE
            $table->string('nim', 9); // Sesuaikan panjang NIM jika perlu
            $table->timestamps();

            // Definisi Foreign Key ke tabel master
            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            // Pastikan 1 mahasiswa hanya bisa didaftarkan sekali
            $table->unique('nim');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mhsmahad');
    }
};