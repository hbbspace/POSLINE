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
                'nik' => 3501011111800011,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501012222800012,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501013333800013,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501014444800014,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501015555800015,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501016666800016,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501017777800017,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501018888800018,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501019999800019,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501020000800020,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501021000800021,
                'pemeriksaan_id' => 1,
                'status' => 'Terdaftar',
            ],
        ]);
    }
}
