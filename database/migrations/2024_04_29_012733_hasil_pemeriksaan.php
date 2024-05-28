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
        Schema::create('hasil_pemeriksaan', function (Blueprint $table) {
            $table->increments('hasil_id');
            $table->string('nik', 16);
            $table->integer('pemeriksaan_id')->unsigned();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->integer('usia')->nullable();
            $table->float('tinggi_badan', 5, 2)->nullable();
            $table->float('berat_badan', 5, 2)->nullable();
            $table->float('lingkar_kepala', 5, 2)->nullable();
            $table->enum('riwayat_penyakit', ['Tidak ada', 'Ringan', 'Berat'])->nullable();
            $table->integer('ranking')->nullable();
            $table->enum('status', ['Stunting', 'Tidak'])->nullable();
            $table->string('catatan', 255)->nullable();
            // Tambahkan kolom lain sesuai kebutuhan

            // Tambahkan foreign key
            $table->foreign('nik')->references('nik')->on('anggota_keluarga');
            $table->foreign('pemeriksaan_id')->references('pemeriksaan_id')->on('pemeriksaan');
            $table->foreign('admin_id')->references('admin_id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_pemeriksaan');
    }
};
