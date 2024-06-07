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
        Schema::create('data_acuan', function (Blueprint $table) {
            $table->integer('usia', 2)->primary();
            $table->float('TB_L', 3);
            // $table->float('BB-L_max', 3);
            $table->float('TB_P', 3);
            // $table->float('BB-P_max', 3);
            $table->float('BB_L', 3);
            // $table->float('TB-L_max', 3);
            $table->float('BB_P', 3);
            // $table->float('TB-P_max', 3);
            $table->float('LK_L', 3);
            // $table->float('LK-L_max', 3);
            $table->float('LK_P', 3);
            // $table->float('LK-P_max', 3);
            // Tambahkan kolom lain sesuai kebutuhan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_acuan');
    }
};
