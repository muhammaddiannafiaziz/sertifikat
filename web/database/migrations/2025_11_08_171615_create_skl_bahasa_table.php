<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skl_bahasa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->unique()->constrained('mahasiswas')->onDelete('cascade');
            $table->string('no_sertifikat')->unique();

            // SKL Bahasa Arab
            $table->unsignedSmallInteger('istima')->nullable();
            $table->unsignedSmallInteger('kitabah')->nullable();
            $table->unsignedSmallInteger('qiraah')->nullable();

            // SKL Bahasa Inggris
            $table->unsignedSmallInteger('listening')->nullable();
            $table->unsignedSmallInteger('writing')->nullable();
            $table->unsignedSmallInteger('reading')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skl_bahasa');
    }
};