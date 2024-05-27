<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataAcuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_acuan')->insert([
            [
                'umur' => 3,
                'BB-L_min' => 1,
                'BB-L_max' => 1,
                'BB-P_min' => 82.00,
                'BB-P_max' => 13.00,
                'TB-L_min' => 41.00,
                'TB-L_max' => '2',
                'TB-P_min' => 'Batuk dan pilek',
                'TB-P_max' => 'Batuk dan pilek',
                'LK-L_min' => 'Batuk dan pilek',
                'LK-L_max' => 'Batuk dan pilek',
                'LK-P_min' => 'Batuk dan pilek',
                'LK-P_max' => 'Batuk dan pilek',
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
