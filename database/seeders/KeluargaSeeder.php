<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('keluarga')->insert([
            [
                'no_kk' => '1234567890123456',
                'alamat' => 'Jl. Merdeka, Malang',
            ],
            [
                'no_kk' => '6543210987654321',
                'alamat' => 'Jl. Sudirman, Surabaya',
            ],
        ]);
    }
}
