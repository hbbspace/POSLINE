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
            [
                'nik' => '1234567890123456',
                'no_kk' => '1234567890123456',
                'nama' => 'Udin',
                'tanggal_lahir' => '1990-01-01',
                'jk' => 'L',
                'status' => 'ibu',
            ],
            [
                'nik' => '6543210987654321',
                'no_kk' => '1234567890123456',
                'nama' => 'Ani',
                'tanggal_lahir' => '1992-02-02',
                'jk' => 'P',
                'status' => 'anak',
            ],
            [
                'nik' => '7890123456789012',
                'no_kk' => '6543210987654321',
                'nama' => 'Budi',
                'tanggal_lahir' => '1995-03-03',
                'jk' => 'L',
                'status' => 'ibu',
            ],
            [
                'nik' => '9876543210987654',
                'no_kk' => '6543210987654321',
                'nama' => 'Cici',
                'tanggal_lahir' => '1997-04-04',
                'jk' => 'P',
                'status' => 'anak',
            ],
        ]);
    }
}
