<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus tabel lama
        Schema::dropIfExists('sertifikats');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Buat KEMBALI tabel lama jika di-rollback
        // Ini adalah skema FINAL dari tabel 'sertifikats' Anda
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained()->onDelete('cascade');
            $table->string('no_sertifikat')->unique();
            $table->enum('status_ujian_ibadah', ['lulus', 'tidak_lulus']);
            $table->enum('status_ujian_alquran', ['lulus', 'tidak_lulus']);
            $table->string('background_image')->nullable();
            
            $table->unsignedSmallInteger('istima')->nullable();
            $table->unsignedSmallInteger('kitabah')->nullable();
            $table->unsignedSmallInteger('qiraah')->nullable();
            $table->unsignedSmallInteger('listening')->nullable();
            $table->unsignedSmallInteger('writing')->nullable();
            $table->unsignedSmallInteger('reading')->nullable();
            $table->unsignedSmallInteger('word')->nullable();
            $table->unsignedSmallInteger('excel')->nullable();
            $table->unsignedSmallInteger('power_point')->nullable();
            
            $table->timestamps();
        });
    }
};