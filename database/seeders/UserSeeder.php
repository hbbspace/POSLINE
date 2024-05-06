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
                'username' => '1234567890123456',
                'password' => bcrypt('123'),
            ],
            [
                'username' => '7890123456789012',
                'password' => bcrypt('123'),
            ],
        ]);
    }
}
