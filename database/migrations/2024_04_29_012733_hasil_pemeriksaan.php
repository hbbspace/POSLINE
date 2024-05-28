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
            $table->integer('usia')->nullable(); // Diisi oleh Petugas
            $table->float('tinggi_badan', 3, 2)->nullable(); // Diisi oleh Petugas
            $table->float('berat_badan', 3, 2)->nullable(); // Diisi oleh Petugas
            $table->float('lingkar_badan', 3, 2)->nullable(); // Diisi oleh Petugas
            $table->enum('riwayat_penyakit', ['Tidak ada', 'Ringan', 'Berat'])->nullable(); // Diisi oleh Petugas
            $table->enum('asupan_makanan', ['Baik', 'Cukup', 'Kurang'])->nullable(); // Diisi oleh Petugas
            $table->enum('status_gizi', ['Baik', 'Cukup', 'Kurang'])->nullable();
            $table->enum('stunting', ['1', '2', '3','Tidak'])->nullable();
            $table->enum('status', ['Terdaftar','Selesai']);
            $table->integer('ranking')->nullable();
            $table->string('catatan', 255)->nullable(); // Diisi oleh Petugas
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
