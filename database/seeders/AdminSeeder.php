<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'username' => 'adminrifki',
                'password' => bcrypt('123'),
                'nama_admin' => 'Rifki Setiawan',
                'jk' => 'L',
                'level' => '1',
            ],
            [
                'username' => 'adminhabib',
                'password' => bcrypt('234'),
                'nama_admin' => 'Habibatul Mustofa',
                'jk' => 'L',
                'level' => '2',
            ],
            [
                'username' => 'adminfajar',
                'password' => bcrypt('345'),
                'nama_admin' => 'Fajar Bayu Kusuma',
                'jk' => 'L',
                'level' => '2',
            ],
            [
                'username' => 'adminbagus',
                'password' => bcrypt('456'),
                'nama_admin' => 'Sukma Bagus Wahasdwika',
                'jk' => 'L',
                'level' => '2',
            ],
            [
                'username' => 'admin1',
                'password' => bcrypt('567'),
                'nama_admin' => 'Ani Lestari',
                'jk' => 'P',
                'level' => '2',
            ],
        ]);
    }
}
