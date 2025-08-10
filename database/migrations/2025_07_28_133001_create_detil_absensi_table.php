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
        Schema::create('detil_absensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_absensi');
            $table->unsignedBigInteger('id_siswa');
            $table->enum('status_kehadiran', ['Hadir', 'Sakit', 'Izin', 'Alpha'])->default('Alpha');
            $table->timestamps();

            $table->foreign('id_absensi')->references('id')->on('absensi')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detil_absensi');
    }
};
