<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemeriksaan')->insert([
            [
                'agenda' => 'Pemeriksaan Balita Sehat',
                'tanggal' => '2024-04-20',
                'tempat' => 'Posyandu Melati',
            ]
        ]);
    }
}
