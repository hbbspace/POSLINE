<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('balita')->insert([
            [
                'nik' => '6543210987654321',
                'tinggi_badan' => 80.00,
                'berat_badan' => 12.00,
                'lingkar_kepala' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nik' => '9876543210987654',
                'tinggi_badan' => 75.00,
                'berat_badan' => 10.00,
                'lingkar_kepala' => 38.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
