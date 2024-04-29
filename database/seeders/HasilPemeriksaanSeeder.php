<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilPemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hasil_pemeriksaan')->insert([
            [
                'balita_id' => 1,
                'pemeriksaan_id' => 1,
                'admin_id' => 1,
                'tinggi_badan' => 82.00,
                'berat_badan' => 13.00,
                'lingkar_kepala' => 41.00,
                'nilai_kesehatan' => '2',
                'catatan' => 'Batuk dan pilek',
            ],
            [
                'balita_id' => 2,
                'pemeriksaan_id' => 2,
                'admin_id' => 2,
                'tinggi_badan' => 76.00,
                'berat_badan' => 11.00,
                'lingkar_kepala' => 39.00,
                'nilai_kesehatan' => '3',
                'catatan' => 'Sehat',
            ],
        ]);
    }
}
