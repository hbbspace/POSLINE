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
        Schema::create('keluarga', function (Blueprint $table) {
            $table->string('no_kk', 16)->primary();
            $table->string('alamat', 100);
            $table->decimal('pendapatan', 15, 2);
            $table->integer('jam_kerja')->unsigned()->nullable();
            // Tambahkan kolom lain sesuai kebutuhan
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('keluarga');
    }
};
