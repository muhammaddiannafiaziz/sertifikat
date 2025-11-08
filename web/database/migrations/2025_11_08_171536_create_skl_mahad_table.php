<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skl_mahad', function (Blueprint $table) {
            $table->id();
            // Relasi unik: 1 mahasiswa hanya punya 1 record skl_mahad
            $table->foreignId('mahasiswa_id')->unique()->constrained('mahasiswas')->onDelete('cascade');
            $table->string('no_sertifikat')->unique();
            $table->enum('status_ujian_ibadah', ['lulus', 'tidak_lulus']);
            $table->enum('status_ujian_alquran', ['lulus', 'tidak_lulus']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skl_mahad');
    }
};