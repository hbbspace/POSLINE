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
        Schema::create('balita', function (Blueprint $table) {
            $table->increments('balita_id');
            $table->string('nik', 16);
            $table->float('tinggi_badan', 4)->nullable();
            $table->float('berat_badan', 3)->nullable();
            $table->float('lingkar_kepala', 3)->nullable();
            // Tambahkan kolom lain sesuai kebutuhan

            // Tambahkan foreign key
            $table->foreign('nik')->references('nik')->on('anggota_keluarga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balita');
    }
};
