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
                'nik' => '3501015010100001',
                'username' => '3501015010100001',
                'password' => bcrypt('3501015010100001'),
            ],
            [
                'nik' => '3501012002800002',
                'username' => '3501012002800002',
                'password' => bcrypt('3501012002800002'),
            ],
            [
                'nik' => '3501013003800003',
                'username' => '3501013003800003',
                'password' => bcrypt('3501013003800003'),
            ],
            [
                'nik' => '3501014004800004',
                'username' => '3501014004800004',
                'password' => bcrypt('3501014004800004'),
            ],
            [
                'nik' => '3501015005800005',
                'username' => '3501015005800005',
                'password' => bcrypt('3501015005800005'),
            ],
            [
                'nik' => '3501016006800006',
                'username' => '3501016006800006',
                'password' => bcrypt('3501016006800006'),
            ],
            [
                'nik' => '3501017007800007',
                'username' => '3501017007800007',
                'password' => bcrypt('3501017007800007'),
            ],
            [
                'nik' => '3501018008800008',
                'username' => '3501018008800008',
                'password' => bcrypt('3501018008800008'),
            ],
            [
                'nik' => '3501019009800009',
                'username' => '3501019009800009',
                'password' => bcrypt('3501019009800009'),
            ],
            [
                'nik' => '3501020010800010',
                'username' => '3501020010800010',
                'password' => bcrypt('3501020010800010'),
            ],
        ]);
    }
}
