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
                'admin_id' => 2,
                'usia' => 16,
                'tinggi_badan' => 78,
                'berat_badan' => 10.5,
                'lingkar_kepala' => 45.3,
                'riwayat_penyakit' => 'Tidak ada',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501012222800012,
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 51,
                'tinggi_badan' => 109.8,
                'berat_badan' => 15,
                'lingkar_kepala' => 49.7,
                'riwayat_penyakit' => 'Ringan',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501013333800013,
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 25,
                'tinggi_badan' => 91.4,
                'berat_badan' => 12.0,
                'lingkar_kepala' => 44,
                'riwayat_penyakit' => 'Berat',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501014444800014,
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 37,
                'tinggi_badan' => 110,
                'berat_badan' => 18,
                'lingkar_kepala' => 45,
                'riwayat_penyakit' => 'Ringan',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501015555800015,
                'pemeriksaan_id' => 1,
                'admin_id' => 4,
                'usia' => 12,
                'tinggi_badan' => 70,
                'berat_badan' => 7.5,
                'lingkar_kepala' => 42.2,
                'riwayat_penyakit' => 'Berat',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501016666800016,
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 23,
                'tinggi_badan' => 80,
                'berat_badan' => 10,
                'lingkar_kepala' => 45,
                'riwayat_penyakit' => 'Ringan',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501017777800017,
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 58,
                'tinggi_badan' => 115,
                'berat_badan' => 16,
                'lingkar_kepala' => 48,
                'riwayat_penyakit' => 'Tidak ada',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501018888800018,
                'pemeriksaan_id' => 1,
                'admin_id' => 5,
                'usia' => 21,
                'tinggi_badan' => 79,
                'berat_badan' => 9.5,
                'lingkar_kepala' => 44,
                'riwayat_penyakit' => 'Tidak ada',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501019999800019,
                'pemeriksaan_id' => 1,
                'admin_id' => 4,
                'usia' => 8,
                'tinggi_badan' => 71,
                'berat_badan' => 9,
                'lingkar_kepala' => 40,
                'riwayat_penyakit' => 'Ringan',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501020000800020,
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 19,
                'tinggi_badan' => 85,
                'berat_badan' => 12,
                'lingkar_kepala' => 46,
                'riwayat_penyakit' => 'Tidak ada',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501021000800021,
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 9,
                'tinggi_badan' => 70,
                'berat_badan' => 10,
                'lingkar_kepala' => 43.5,
                'riwayat_penyakit' => 'Tidak ada',
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
