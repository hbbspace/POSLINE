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
            $table->integer('balita_id')->unsigned();
            $table->integer('pemeriksaan_id')->unsigned();
            $table->integer('admin_id')->unsigned();
            $table->float('tinggi_badan', 4);
            $table->float('berat_badan', 3);
            $table->float('lingkar_kepala', 3);
            $table->enum('nilai_kesehatan', ['1', '2', '3', '4', '5']);
            $table->string('catatan')->nullable();
            // Tambahkan kolom lain sesuai kebutuhan

            // Tambahkan foreign key
            $table->foreign('balita_id')->references('balita_id')->on('balita');
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
