<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_hari = [
            [
                "hari_nama" => "Senin",
            ],
            [
                "hari_nama" => "Selasa",
            ],
            [
                "hari_nama" => "Rabu",
            ],
            [
                "hari_nama" => "Kamis",
            ],
            [
                "hari_nama" => "Jumat",
            ],
        ];

        DB::table('hari')->insert($list_hari);
    }
}
