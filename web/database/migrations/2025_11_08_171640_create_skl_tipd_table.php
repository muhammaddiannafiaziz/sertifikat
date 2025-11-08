<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skl_tipd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->unique()->constrained('mahasiswas')->onDelete('cascade');
            $table->string('no_sertifikat')->unique();

            // SKL Komputer
            $table->unsignedSmallInteger('word')->nullable();
            $table->unsignedSmallInteger('excel')->nullable();
            $table->unsignedSmallInteger('power_point')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skl_tipd');
    }
};