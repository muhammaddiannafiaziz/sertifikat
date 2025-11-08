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
        Schema::table('sertifikats', function (Blueprint $table) {
            // SKL Bahasa Arab
            $table->unsignedSmallInteger('istima')->nullable()->after('background_image');
            $table->unsignedSmallInteger('kitabah')->nullable()->after('istima');
            $table->unsignedSmallInteger('qiraah')->nullable()->after('kitabah');

            // SKL Bahasa Inggris
            $table->unsignedSmallInteger('listening')->nullable()->after('qiraah');
            $table->unsignedSmallInteger('writing')->nullable()->after('listening');
            $table->unsignedSmallInteger('reading')->nullable()->after('writing');

            // SKL Komputer
            $table->unsignedSmallInteger('word')->nullable()->after('reading');
            $table->unsignedSmallInteger('excel')->nullable()->after('word');
            $table->unsignedSmallInteger('power_point')->nullable()->after('excel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikats', function (Blueprint $table) {
            $table->dropColumn([
                'istima', 'kitabah', 'qiraah',
                'listening', 'writing', 'reading',
                'word', 'excel', 'power_point'
            ]);
        });
    }
};