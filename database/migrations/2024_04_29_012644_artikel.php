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
        Schema::create('artikel', function (Blueprint $table) {
            $table->increments('artikel_id');
            $table->integer('admin_id')->unsigned();
            $table->string('judul');
            $table->text('konten');
            $table->date('tgl_publikasi');
            $table->string('gambar');
            // Tambahkan kolom lain sesuai kebutuhan

            // Tambahkan foreign key
            $table->foreign('admin_id')->references('admin_id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
