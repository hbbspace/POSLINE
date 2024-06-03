<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('keluarga')->insert([
            [
                'no_kk' => '3501012233445566',
                'alamat' => 'Jl. Kesumba Dalam No. 4, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 2500000,
                'jam_kerja' => 5
            ],
            [
                'no_kk' => '3501013344556677',
                'alamat' => 'Jl. Kesumba No. 5, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 4000000,
                'jam_kerja' => 12
            ],
            [
                'no_kk' => '3501014455667788',
                'alamat' => 'Jl. Semanggi Barat No. 6, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 3000000,
                'jam_kerja' => 9
            ],
            [
                'no_kk' => '3501015566778899',
                'alamat' => 'Jl. Senggani No. 7, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 4500000,
                'jam_kerja' => 7
            ],
            [
                'no_kk' => '3501016677889900',
                'alamat' => 'Jl. Simbar Menjangan No. 8, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 7000000,
                'jam_kerja' => 10
            ],
            [
                'no_kk' => '3501017788990011',
                'alamat' => 'Jl. Bunga Coklat No. 9, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 6500000,
                'jam_kerja' => 7
            ],
            [
                'no_kk' => '3501018899001122',
                'alamat' => 'Jl. Pisang Kipas No. 10, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 8000000,
                'jam_kerja' => 11
            ],
            [
                'no_kk' => '3501019900112233',
                'alamat' => 'Jl. Griyashanta Eksekutif No. 11, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 9000000,
                'jam_kerja' => 8
            ],
            [
                'no_kk' => '3501020011223344',
                'alamat' => 'Jl. Kembang Kertas No. 12, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 7500000,
                'jam_kerja' => 13
            ],
            [
                'no_kk' => '3501021122334455',
                'alamat' => 'Jl. Kembang Turi No. 13, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 5000000,
                'jam_kerja' => 8
            ]
        ]);
    }
}
