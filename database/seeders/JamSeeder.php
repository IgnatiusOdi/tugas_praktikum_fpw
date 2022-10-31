<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_jam = [
            [
                "jam_nama" => "06:00",
            ],
            [
                "jam_nama" => "07:00",
            ],
            [
                "jam_nama" => "08:00",
            ],
            [
                "jam_nama" => "09:00",
            ],
            [
                "jam_nama" => "10:00",
            ],
            [
                "jam_nama" => "11:00",
            ],
            [
                "jam_nama" => "12:00",
            ],
            [
                "jam_nama" => "13:00",
            ],
            [
                "jam_nama" => "14:00",
            ],
            [
                "jam_nama" => "15:00",
            ],
            [
                "jam_nama" => "16:00",
            ],
            [
                "jam_nama" => "17:00",
            ],
            [
                "jam_nama" => "18:00",
            ],
            [
                "jam_nama" => "19:00",
            ],
            [
                "jam_nama" => "20:00",
            ],
            [
                "jam_nama" => "21:00",
            ],
            [
                "jam_nama" => "22:00",
            ],
            [
                "jam_nama" => "23:00",
            ],
        ];

        DB::table('jam')->insert($list_jam);
    }
}
