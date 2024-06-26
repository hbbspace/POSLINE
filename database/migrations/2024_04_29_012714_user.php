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
        Schema::create('user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('nik', 16);
            $table->string('username', 25);
            $table->string('password', 60);
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
        Schema::dropIfExists('user');
    }
};
