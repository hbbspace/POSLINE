<?php

namespace Database\Seeders;

use App\Models\AnggotaKeluargaModel;
use App\Models\DataAcuanModel;
use App\Models\HasilPemeriksaanModel;
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
            ['nik' => 3501011111800011, 'pemeriksaan_id' => 1, 'admin_id' => 2, 'usia' => 12, 'tinggi_badan' => 72, 'berat_badan' => 8.2, 'lingkar_badan' => 39, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Tidak', 'status' => 'Selesai'],
            ['nik' => 3501012222800012, 'pemeriksaan_id' => 1, 'admin_id' => 2, 'usia' => 47, 'tinggi_badan' => 103, 'berat_badan' => 14, 'lingkar_badan' => 53, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501013333800013, 'pemeriksaan_id' => 1, 'admin_id' => 4, 'usia' => 21, 'tinggi_badan' => 83, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Tinggi', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501014444800014, 'pemeriksaan_id' => 1, 'admin_id' => 4, 'usia' => 33, 'tinggi_badan' => 92, 'berat_badan' => 12, 'lingkar_badan' => 52, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501015555800015, 'pemeriksaan_id' => 1, 'admin_id' => 2, 'usia' => 8, 'tinggi_badan' => 70, 'berat_badan' => 9, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501016666800016, 'pemeriksaan_id' => 1, 'admin_id' => 2, 'usia' => 19, 'tinggi_badan' => 80, 'berat_badan' => 10, 'lingkar_badan' => 47, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501017777800017, 'pemeriksaan_id' => 1, 'admin_id' => 3, 'usia' => 54, 'tinggi_badan' => 108, 'berat_badan' => 15, 'lingkar_badan' => 55, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501018888800018, 'pemeriksaan_id' => 1, 'admin_id' => 4, 'usia' => 17, 'tinggi_badan' => 79, 'berat_badan' => 9.5, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501019999800019, 'pemeriksaan_id' => 1, 'admin_id' => 4, 'usia' => 4, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 35, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Tinggi', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501020000800020, 'pemeriksaan_id' => 1, 'admin_id' => 2, 'usia' => 15, 'tinggi_badan' => 77, 'berat_badan' => 11, 'lingkar_badan' => 44.5, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501021000800021, 'pemeriksaan_id' => 1, 'admin_id' => 4, 'usia' => 5, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 38, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501011111800011, 'pemeriksaan_id' => 2, 'admin_id' => 2, 'usia' => 13, 'tinggi_badan' => 73, 'berat_badan' => 8.4, 'lingkar_badan' => 40, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Tidak', 'status' => 'Selesai'],
            ['nik' => 3501012222800012, 'pemeriksaan_id' => 2, 'admin_id' => 3, 'usia' => 48, 'tinggi_badan' => 103, 'berat_badan' => 14, 'lingkar_badan' => 53, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501013333800013, 'pemeriksaan_id' => 2, 'admin_id' => 3, 'usia' => 22, 'tinggi_badan' => 83, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Tinggi', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501014444800014, 'pemeriksaan_id' => 2, 'admin_id' => 3, 'usia' => 34, 'tinggi_badan' => 92, 'berat_badan' => 12, 'lingkar_badan' => 52, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501015555800015, 'pemeriksaan_id' => 2, 'admin_id' => 2, 'usia' => 9, 'tinggi_badan' => 70, 'berat_badan' => 9, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501016666800016, 'pemeriksaan_id' => 2, 'admin_id' => 2, 'usia' => 21, 'tinggi_badan' => 80, 'berat_badan' => 10, 'lingkar_badan' => 47, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501017777800017, 'pemeriksaan_id' => 2, 'admin_id' => 2, 'usia' => 55, 'tinggi_badan' => 108, 'berat_badan' => 15, 'lingkar_badan' => 55, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501018888800018, 'pemeriksaan_id' => 2, 'admin_id' => 3, 'usia' => 18, 'tinggi_badan' => 79, 'berat_badan' => 9.5, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501019999800019, 'pemeriksaan_id' => 2, 'admin_id' => 3, 'usia' => 5, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 35, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Tinggi', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501020000800020, 'pemeriksaan_id' => 2, 'admin_id' => 2, 'usia' => 16, 'tinggi_badan' => 77, 'berat_badan' => 11, 'lingkar_badan' => 44.5, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501021000800021, 'pemeriksaan_id' => 2, 'admin_id' => 4, 'usia' => 6, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 38, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501011111800011, 'pemeriksaan_id' => 3, 'admin_id' => 2, 'usia' => 14, 'tinggi_badan' => 74, 'berat_badan' => 8.6, 'lingkar_badan' => 41, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Tidak', 'status' => 'Selesai'],
            ['nik' => 3501012222800012, 'pemeriksaan_id' => 3, 'admin_id' => 2, 'usia' => 49, 'tinggi_badan' => 103, 'berat_badan' => 14, 'lingkar_badan' => 53, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501013333800013, 'pemeriksaan_id' => 3, 'admin_id' => 2, 'usia' => 23, 'tinggi_badan' => 83, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Tinggi', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501014444800014, 'pemeriksaan_id' => 3, 'admin_id' => 3, 'usia' => 35, 'tinggi_badan' => 92, 'berat_badan' => 12, 'lingkar_badan' => 52, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501015555800015, 'pemeriksaan_id' => 3, 'admin_id' => 4, 'usia' => 10, 'tinggi_badan' => 70, 'berat_badan' => 9, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501016666800016, 'pemeriksaan_id' => 3, 'admin_id' => 2, 'usia' => 21, 'tinggi_badan' => 80, 'berat_badan' => 10, 'lingkar_badan' => 47, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501017777800017, 'pemeriksaan_id' => 3, 'admin_id' => 4, 'usia' => 56, 'tinggi_badan' => 108, 'berat_badan' => 15, 'lingkar_badan' => 55, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501018888800018, 'pemeriksaan_id' => 3, 'admin_id' => 2, 'usia' => 19, 'tinggi_badan' => 79, 'berat_badan' => 9.5, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501019999800019, 'pemeriksaan_id' => 3, 'admin_id' => 3, 'usia' => 6, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 35, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Tinggi', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501020000800020, 'pemeriksaan_id' => 3, 'admin_id' => 3, 'usia' => 17, 'tinggi_badan' => 77, 'berat_badan' => 11, 'lingkar_badan' => 44.5, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501021000800021, 'pemeriksaan_id' => 3, 'admin_id' => 4, 'usia' => 7, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 38, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501011111800011, 'pemeriksaan_id' => 4, 'admin_id' => 4, 'usia' => 15, 'tinggi_badan' => 75, 'berat_badan' => 8.8, 'lingkar_badan' => 42, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Tidak', 'status' => 'Selesai'],
            ['nik' => 3501012222800012, 'pemeriksaan_id' => 4, 'admin_id' => 2, 'usia' => 50, 'tinggi_badan' => 103, 'berat_badan' => 14, 'lingkar_badan' => 53, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501013333800013, 'pemeriksaan_id' => 4, 'admin_id' => 3, 'usia' => 24, 'tinggi_badan' => 83, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Tinggi', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501014444800014, 'pemeriksaan_id' => 4, 'admin_id' => 4, 'usia' => 36, 'tinggi_badan' => 92, 'berat_badan' => 12, 'lingkar_badan' => 52, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501015555800015, 'pemeriksaan_id' => 4, 'admin_id' => 3, 'usia' => 11, 'tinggi_badan' => 70, 'berat_badan' => 9, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501016666800016, 'pemeriksaan_id' => 4, 'admin_id' => 3, 'usia' => 22, 'tinggi_badan' => 79, 'berat_badan' => 10, 'lingkar_badan' => 47, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501017777800017, 'pemeriksaan_id' => 4, 'admin_id' => 3, 'usia' => 57, 'tinggi_badan' => 107, 'berat_badan' => 15, 'lingkar_badan' => 55, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501018888800018, 'pemeriksaan_id' => 4, 'admin_id' => 2, 'usia' => 20, 'tinggi_badan' => 78, 'berat_badan' => 9.5, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501019999800019, 'pemeriksaan_id' => 4, 'admin_id' => 3, 'usia' => 7, 'tinggi_badan' => 64, 'berat_badan' => 7, 'lingkar_badan' => 34, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Tinggi', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501020000800020, 'pemeriksaan_id' => 4, 'admin_id' => 2, 'usia' => 18, 'tinggi_badan' => 76.5, 'berat_badan' => 10, 'lingkar_badan' => 42.5, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501021000800021, 'pemeriksaan_id' => 4, 'admin_id' => 3, 'usia' => 8, 'tinggi_badan' => 64, 'berat_badan' => 7.8, 'lingkar_badan' => 39, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501011111800011, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 16, 'tinggi_badan' => 76, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Tidak', 'status' => 'Selesai'],
            ['nik' => 3501012222800012, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 51, 'tinggi_badan' => 103, 'berat_badan' => 14, 'lingkar_badan' => 53, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501013333800013, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 25, 'tinggi_badan' => 83, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Tinggi', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501014444800014, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 37, 'tinggi_badan' => 92, 'berat_badan' => 12, 'lingkar_badan' => 52, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501015555800015, 'pemeriksaan_id' => 5, 'admin_id' => 4, 'usia' => 12, 'tinggi_badan' => 70, 'berat_badan' => 9, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501016666800016, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 23, 'tinggi_badan' => 80, 'berat_badan' => 10, 'lingkar_badan' => 47, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501017777800017, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 58, 'tinggi_badan' => 108, 'berat_badan' => 15, 'lingkar_badan' => 55, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501018888800018, 'pemeriksaan_id' => 5, 'admin_id' => 5, 'usia' => 21, 'tinggi_badan' => 79, 'berat_badan' => 9.5, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Rendah', 'status' => 'Selesai'],
            ['nik' => 3501019999800019, 'pemeriksaan_id' => 5, 'admin_id' => 4, 'usia' => 8, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 35, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Tinggi', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501020000800020, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 19, 'tinggi_badan' => 77, 'berat_badan' => 11, 'lingkar_badan' => 44.5, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
            ['nik' => 3501021000800021, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 9, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 38, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        ]);

        $existing_data = HasilPemeriksaanModel::all();

        foreach ($existing_data as $data) {
            if ($data->nik == 3501011111800011 || $data->pemeriksaan_id == 5) {
                
            } else {
                $nik = $data->nik;
                $admin = rand(2, 4);

                $jk_record = AnggotaKeluargaModel::select('anggota_keluarga.jk')
                    ->where('anggota_keluarga.nik', $nik)
                    ->first();
                if ($jk_record) {
                    $jk = $jk_record->jk;

                    $usia = $data->usia;

                    $acuan = DataAcuanModel::where('usia', $usia)->first();
                    if ($acuan) {
                        if ($jk == 'P') {
                            $tinggi_badan = rand($acuan->TB_P - 10, $acuan->TB_P);
                            $berat_badan = rand($acuan->BB_P - 5, $acuan->BB_P + 1);
                            $lingkar_badan = rand($acuan->LB_P - 5, $acuan->LB_P + 1);
                            $malnutrisi = ($berat_badan - $acuan->BB_P) + ($lingkar_badan - $acuan->LB_P);
                            if ($tinggi_badan >= $acuan->TB_P) {
                                $stunting = 'Tidak';
                            } else if ($tinggi_badan >= $acuan->TB_P - 2) {
                                $stunting = 'Rendah';
                            } else if ($tinggi_badan >= $acuan->TB_P - 5) {
                                $stunting = 'Sedang';
                            } else {
                                $stunting = 'Tinggi';
                            }
                        } else if ($jk == 'L') {
                            $tinggi_badan = rand($acuan->TB_L - 10, $acuan->TB_L);
                            $berat_badan = rand($acuan->BB_L - 3, $acuan->BB_L + 3);
                            $lingkar_badan = rand($acuan->LB_L - 5, $acuan->LB_L + 5);
                            $malnutrisi = ($berat_badan - $acuan->BB_L) + ($lingkar_badan - $acuan->LB_L);
                            if ($tinggi_badan >= $acuan->TB_L) {
                                $stunting = 'Tidak';
                            } else if ($tinggi_badan >= $acuan->TB_L - 2) {
                                $stunting = 'Rendah';
                            } else if ($tinggi_badan >= $acuan->TB_L - 5) {
                                $stunting = 'Sedang';
                            } else {
                                $stunting = 'Tinggi';
                            }
                        }

                        if($malnutrisi >= 0){
                            $nilaimalnutrisi = 'Rendah';
                        }else if($malnutrisi >= -3){
                            $nilaimalnutrisi = 'Sedang';
                        }else{
                            $nilaimalnutrisi = 'Tinggi';
                        }

                        $gangguan_kesehatan_options = ['Tidak ada', 'Ringan','Sedang', 'Berat'];
                        $gangguan_kesehatan = $gangguan_kesehatan_options[array_rand($gangguan_kesehatan_options)];

                        DB::table('hasil_pemeriksaan')
                            ->where('hasil_id', $data->hasil_id)
                            ->update([
                                'admin_id' => $admin,
                                'usia' => $usia,
                                'tinggi_badan' => $tinggi_badan,
                                'berat_badan' => $berat_badan,
                                'lingkar_badan' => $lingkar_badan,
                                'gangguan_kesehatan' => $gangguan_kesehatan,
                                'malnutrisi' => $nilaimalnutrisi,
                                'stunting' => $stunting,
                            ]);
                    }
                }
            }
        }

        
        // DB::table('hasil_pemeriksaan')->insert([
        //     ['nik' => 3501011111800011, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 16, 'tinggi_badan' => 76, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Tidak', 'status' => 'Selesai'],
        //     ['nik' => 3501012222800012, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 51, 'tinggi_badan' => 103, 'berat_badan' => 14, 'lingkar_badan' => 53, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        //     ['nik' => 3501013333800013, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 25, 'tinggi_badan' => 83, 'berat_badan' => 9, 'lingkar_badan' => 43, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Tinggi', 'stunting' => 'Rendah', 'status' => 'Selesai'],
        //     ['nik' => 3501014444800014, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 37, 'tinggi_badan' => 92, 'berat_badan' => 12, 'lingkar_badan' => 52, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        //     ['nik' => 3501015555800015, 'pemeriksaan_id' => 5, 'admin_id' => 4, 'usia' => 12, 'tinggi_badan' => 70, 'berat_badan' => 9, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Berat', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        //     ['nik' => 3501016666800016, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 23, 'tinggi_badan' => 80, 'berat_badan' => 10, 'lingkar_badan' => 47, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        //     ['nik' => 3501017777800017, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 58, 'tinggi_badan' => 108, 'berat_badan' => 15, 'lingkar_badan' => 55, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        //     ['nik' => 3501018888800018, 'pemeriksaan_id' => 5, 'admin_id' => 5, 'usia' => 21, 'tinggi_badan' => 79, 'berat_badan' => 9.5, 'lingkar_badan' => 44, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Rendah', 'status' => 'Selesai'],
        //     ['nik' => 3501019999800019, 'pemeriksaan_id' => 5, 'admin_id' => 4, 'usia' => 8, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 35, 'gangguan_kesehatan' => 'Ringan', 'malnutrisi' => 'Tinggi', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        //     ['nik' => 3501020000800020, 'pemeriksaan_id' => 5, 'admin_id' => 2, 'usia' => 19, 'tinggi_badan' => 77, 'berat_badan' => 11, 'lingkar_badan' => 44.5, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Rendah', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        //     ['nik' => 3501021000800021, 'pemeriksaan_id' => 5, 'admin_id' => 3, 'usia' => 9, 'tinggi_badan' => 65, 'berat_badan' => 7.5, 'lingkar_badan' => 38, 'gangguan_kesehatan' => 'Tidak ada', 'malnutrisi' => 'Sedang', 'stunting' => 'Sedang', 'status' => 'Selesai'],
        // ]);

        DB::table('hasil_pemeriksaan')->insert([
            ['nik' => 3501011111800011, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501012222800012, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501013333800013, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501014444800014, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501015555800015, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501016666800016, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501017777800017, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501018888800018, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501019999800019, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501020000800020, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
            ['nik' => 3501021000800021, 'pemeriksaan_id' => 6, 'status' => 'Terdaftar'],
        ]);
    }
}
