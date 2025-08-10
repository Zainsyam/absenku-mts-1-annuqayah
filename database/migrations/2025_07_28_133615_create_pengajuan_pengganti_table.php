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
        Schema::create('pengajuan_pengganti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jadwal');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_guru');   // guru yang minta diganti
            $table->unsignedBigInteger('id_guru_pengganti')->nullable(); // guru yang diajukan (optional)
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->foreign('id_jadwal')->references('id')->on('jadwal')->onDelete('cascade');
            $table->foreign('id_guru')->references('id')->on('staf')->onDelete('cascade');
            $table->foreign('id_guru_pengganti')->references('id')->on('staf')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pengganti');
    }
};
