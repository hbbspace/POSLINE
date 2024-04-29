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
                'username' => 'admin1',
                'password' => bcrypt('123'),
                'nama_admin' => 'Budi Setiawan',
                'jk' => 'L',
                'level' => '1',
            ],
            [
                'username' => 'admin2',
                'password' => bcrypt('345'),
                'nama_admin' => 'Ani Lestari',
                'jk' => 'P',
                'level' => '2',
            ],
        ]);
    }
}
