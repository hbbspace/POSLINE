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
                'nik' => 3501011111800011, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 16,
                'tinggi_badan' => 76,
                'berat_badan' => 9,
                'lingkar_badan' => 43,
                'riwayat_penyakit' => 'Tidak ada',
                'malnutrisi' => 'Rendah',
                'stunting' => 'Tidak',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501012222800012, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 51,
                'tinggi_badan' => 103,
                'berat_badan' => 14,
                'lingkar_badan' => 53,
                'riwayat_penyakit' => 'Ringan',
                'malnutrisi' => 'Sedang',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501013333800013, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 25,
                'tinggi_badan' => 83,
                'berat_badan' => 9,
                'lingkar_badan' => 43,
                'riwayat_penyakit' => 'Berat',
                'malnutrisi' => 'Tinggi',
                'stunting' => 'Rendah',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501014444800014, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 37,
                'tinggi_badan' => 92,
                'berat_badan' => 12,
                'lingkar_badan' => 52,
                'riwayat_penyakit' => 'Ringan',
                'malnutrisi' => 'Rendah',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501015555800015, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 4,
                'usia' => 12,
                'tinggi_badan' => 70,
                'berat_badan' => 9,
                'lingkar_badan' => 44,
                'riwayat_penyakit' => 'Berat',
                'malnutrisi' => 'Rendah',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501016666800016, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 23,
                'tinggi_badan' => 80,
                'berat_badan' => 10,
                'lingkar_badan' => 47,
                'riwayat_penyakit' => 'Ringan',
                'malnutrisi' => 'Rendah',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501017777800017, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 58,
                'tinggi_badan' => 108,
                'berat_badan' => 15,
                'lingkar_badan' => 55,
                'riwayat_penyakit' => 'Tidak ada',
                'malnutrisi' => 'Rendah',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501018888800018, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 5,
                'usia' => 21,
                'tinggi_badan' => 79,
                'berat_badan' => 9.5,
                'lingkar_badan' => 44,
                'riwayat_penyakit' => 'Tidak ada',
                'malnutrisi' => 'Sedang',
                'stunting' => 'Rendah',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501019999800019, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 4,
                'usia' => 8,
                'tinggi_badan' => 65,
                'berat_badan' => 7.5,
                'lingkar_badan' => 35,
                'riwayat_penyakit' => 'Ringan',
                'malnutrisi' => 'Tinggi',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501020000800020, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 19,
                'tinggi_badan' => 77,
                'berat_badan' => 11,
                'lingkar_badan' => 44.5,
                'riwayat_penyakit' => 'Tidak ada',
                'malnutrisi' => 'Rendah',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501021000800021, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 9,
                'tinggi_badan' => 65,
                'berat_badan' => 7.5,
                'lingkar_badan' => 38,
                'riwayat_penyakit' => 'Tidak ada',
                'malnutrisi' => 'Sedang',
                'stunting' => 'Sedang',
                'status' => 'Selesai',
            ],
        ]);

        DB::table('hasil_pemeriksaan')->insert([
            [
                'nik' => 3501011111800011,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501012222800012,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501013333800013,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501014444800014,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501015555800015,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501016666800016,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501017777800017,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501018888800018,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501019999800019,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501020000800020,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
            [
                'nik' => 3501021000800021,
                'pemeriksaan_id' => 2,
                'status' => 'Terdaftar',
            ],
        ]);
    }
}
