<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnggotaKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('anggota_keluarga')->insert([
            ['nik' => '3501015010100001', 'no_kk' => '3501012233445566', 'nama' => 'Dewi Cahaya', 'tanggal_lahir' => '1995-01-01', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501012002800002', 'no_kk' => '3501013344556677', 'nama' => 'Fitriana Anggun', 'tanggal_lahir' => '1991-02-02', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501013003800003', 'no_kk' => '3501014455667788', 'nama' => 'Gita Permatasari', 'tanggal_lahir' => '2000-03-03', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501014004800004', 'no_kk' => '3501015566778899', 'nama' => 'Hana Wulandari', 'tanggal_lahir' => '1993-04-04', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501015005800005', 'no_kk' => '3501016677889900', 'nama' => 'Ika Ningsih', 'tanggal_lahir' => '1990-05-05', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501016006800006', 'no_kk' => '3501017788990011', 'nama' => 'Juni Amalia', 'tanggal_lahir' => '1997-06-06', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501017007800007', 'no_kk' => '3501018899001122', 'nama' => 'Karin Novilda', 'tanggal_lahir' => '1998-07-07', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501018008800008', 'no_kk' => '3501019900112233', 'nama' => 'Lina Adelia', 'tanggal_lahir' => '1999-08-08', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501019009800009', 'no_kk' => '3501020011223344', 'nama' => 'Mayang Sari', 'tanggal_lahir' => '1988-09-09', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501020010800010', 'no_kk' => '3501021122334455', 'nama' => 'Nina Karin', 'tanggal_lahir' => '1989-10-10', 'jk' => 'P', 'status' => 'ibu'],
            ['nik' => '3501011111800011', 'no_kk' => '3501012233445566', 'nama' => 'Ayu Lestari', 'tanggal_lahir' => '2023-01-01', 'jk' => 'P', 'status' => 'anak'],
            ['nik' => '3501012222800012', 'no_kk' => '3501013344556677', 'nama' => 'Budi Setiawan', 'tanggal_lahir' => '2020-02-02', 'jk' => 'L', 'status' => 'anak'],
            ['nik' => '3501013333800013', 'no_kk' => '3501014455667788', 'nama' => 'Citra Dewi', 'tanggal_lahir' => '2022-03-03', 'jk' => 'P', 'status' => 'anak'],
            ['nik' => '3501014444800014', 'no_kk' => '3501015566778899', 'nama' => 'Dinda Najwa', 'tanggal_lahir' => '2021-04-04', 'jk' => 'P', 'status' => 'anak'],
            ['nik' => '3501015555800015', 'no_kk' => '3501016677889900', 'nama' => 'Eka Krisna', 'tanggal_lahir' => '2023-05-05', 'jk' => 'L', 'status' => 'anak'],
            ['nik' => '3501016666800016', 'no_kk' => '3501017788990011', 'nama' => 'Fira Sagita', 'tanggal_lahir' => '2022-06-06', 'jk' => 'P', 'status' => 'anak'],
            ['nik' => '3501017777800017', 'no_kk' => '3501018899001122', 'nama' => 'Gilang Dirga', 'tanggal_lahir' => '2019-07-07', 'jk' => 'L', 'status' => 'anak'],
            ['nik' => '3501018888800018', 'no_kk' => '3501019900112233', 'nama' => 'Hani Wulandari', 'tanggal_lahir' => '2021-08-08', 'jk' => 'P', 'status' => 'anak'],
            ['nik' => '3501019999800019', 'no_kk' => '3501020011223344', 'nama' => 'Indra Sahputra', 'tanggal_lahir' => '2023-09-09', 'jk' => 'L', 'status' => 'anak'],
            ['nik' => '3501020000800020', 'no_kk' => '3501021122334455', 'nama' => 'Joko Widodo', 'tanggal_lahir' => '2022-10-10', 'jk' => 'L', 'status' => 'anak'],
            ['nik' => '3501021000800021', 'no_kk' => '3501021122334455', 'nama' => 'Joko Anwar', 'tanggal_lahir' => '2023-10-10', 'jk' => 'L', 'status' => 'anak']
        ]);
    }
}
