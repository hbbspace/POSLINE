<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'nik' => '1234567890123456',
                'password' => bcrypt('passwordUdin'),
            ],
            [
                'nik' => '7890123456789012',
                'password' => bcrypt('passwordBudi'),
            ],
        ]);
    }
}
