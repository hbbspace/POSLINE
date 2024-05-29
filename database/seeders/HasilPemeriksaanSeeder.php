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
                'tinggi_badan' => 70,
                'berat_badan' => 10.5,
                'lingkar_badan' => 50,
                'riwayat_penyakit' => 'Tidak ada',
                'asupan_makanan' => 'Baik',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501012222800012, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 51,
                'tinggi_badan' => 82,
                'berat_badan' => 17,
                'lingkar_badan' => 62,
                'riwayat_penyakit' => 'Ringan',
                'asupan_makanan' => 'Cukup',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501013333800013, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 25,
                'tinggi_badan' => 72,
                'berat_badan' => 10,
                'lingkar_badan' => 50,
                'riwayat_penyakit' => 'Berat',
                'asupan_makanan' => 'Cukup',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501014444800014, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 37,
                'tinggi_badan' => 75,
                'berat_badan' => 18,
                'lingkar_badan' => 56,
                'riwayat_penyakit' => 'Ringan',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501015555800015, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 4,
                'usia' => 12,
                'tinggi_badan' => 70,
                'berat_badan' => 7.5,
                'lingkar_badan' => 47,
                'riwayat_penyakit' => 'Berat',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501016666800016, // P
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 23,
                'tinggi_badan' => 80,
                'berat_badan' => 10,
                'lingkar_badan' => 51,
                'riwayat_penyakit' => 'Ringan',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501017777800017, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 58,
                'tinggi_badan' => 115,
                'berat_badan' => 16,
                'lingkar_badan' => 66,
                'riwayat_penyakit' => 'Tidak ada',
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
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501019999800019, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 4,
                'usia' => 8,
                'tinggi_badan' => 71,
                'berat_badan' => 9,
                'lingkar_badan' => 40,
                'riwayat_penyakit' => 'Ringan',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501020000800020, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 2,
                'usia' => 19,
                'tinggi_badan' => 85,
                'berat_badan' => 12,
                'lingkar_badan' => 46,
                'riwayat_penyakit' => 'Tidak ada',
                'status' => 'Selesai',
            ],
            [
                'nik' => 3501021000800021, // L
                'pemeriksaan_id' => 1,
                'admin_id' => 3,
                'usia' => 9,
                'tinggi_badan' => 70,
                'berat_badan' => 10,
                'lingkar_badan' => 43.5,
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
