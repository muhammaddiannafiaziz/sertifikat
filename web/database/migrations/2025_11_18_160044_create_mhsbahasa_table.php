<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mhsbahasa', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 9);
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswas')->onDelete('cascade');
            $table->unique('nim');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mhsbahasa');
    }
};