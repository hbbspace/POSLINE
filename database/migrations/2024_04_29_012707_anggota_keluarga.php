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
        Schema::create('anggota_keluarga', function (Blueprint $table) {
            $table->string('nik', 16)->primary();
            $table->string('no_kk', 16);
            $table->string('nama', 50);
            $table->date('tanggal_lahir');
            $table->enum('jk', ['L', 'P']);
            $table->enum('status', ['ibu', 'anak']);
            // Tambahkan kolom lain sesuai kebutuhan

            // Tambahkan foreign key
            $table->foreign('no_kk')->references('no_kk')->on('keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluarga');
    }
};
