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
                'alamat' => 'Jl. Tulip No. 4, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 2500000,
                'jam_kerja' => 5
            ],
            [
                'no_kk' => '3501013344556677',
                'alamat' => 'Jl. Sakura No. 5, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 4000000,
                'jam_kerja' => 12
            ],
            [
                'no_kk' => '3501014455667788',
                'alamat' => 'Jl. Anggrek No. 6, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 3000000,
                'jam_kerja' => 9
            ],
            [
                'no_kk' => '3501015566778899',
                'alamat' => 'Jl. Teratai No. 7, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 4500000,
                'jam_kerja' => 7
            ],
            [
                'no_kk' => '3501016677889900',
                'alamat' => 'Jl. Dandelion No. 8, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 7000000,
                'jam_kerja' => 10
            ],
            [
                'no_kk' => '3501017788990011',
                'alamat' => 'Jl. Kamboja No. 9, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 6500000,
                'jam_kerja' => 7
            ],
            [
                'no_kk' => '3501018899001122',
                'alamat' => 'Jl. Flamboyan No. 10, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 8000000,
                'jam_kerja' => 11
            ],
            [
                'no_kk' => '3501019900112233',
                'alamat' => 'Jl. Bougenville No. 11, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 9000000,
                'jam_kerja' => 8
            ],
            [
                'no_kk' => '3501020011223344',
                'alamat' => 'Jl. Magnolia No. 12, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 7500000,
                'jam_kerja' => 13
            ],
            [
                'no_kk' => '3501021122334455',
                'alamat' => 'Jl. Lili No. 13, Desa Jatimulyo, Kecamatan Lowokwaru, Kota Malang',
                'pendapatan' => 5000000,
                'jam_kerja' => 8
            ]
        ]);
    }
}
