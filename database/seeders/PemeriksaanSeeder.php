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
                'agenda' => 'Sehat Bersama Posyandu',
                'tanggal' => '2024-01-18',
                'tempat' => 'Posyandu Kembang Turi',
            ],
            [
                'agenda' => 'Ceria Sehat Anak',
                'tanggal' => '2024-02-15',
                'tempat' => 'Posyandu Kembang Turi',
            ],
            [
                'agenda' => 'Keluarga Sehat',
                'tanggal' => '2024-03-14',
                'tempat' => 'Posyandu Kembang Turi',
            ],
            [
                'agenda' => 'Siaga Sehat Balita',
                'tanggal' => '2024-04-18',
                'tempat' => 'Posyandu Kembang Turi',
            ],
            [
                'agenda' => 'Posyandu Peduli Kesehatan',
                'tanggal' => '2024-05-16',
                'tempat' => 'Posyandu Kembang Turi',
            ],
            [
                'agenda' => 'Gembira Sehat Balita',
                'tanggal' => '2024-06-20',
                'tempat' => 'Posyandu Kembang Turi',
            ]
        ]);
    }
}