<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_kelas = [
            [
                "matakuliah_id" => "1",
                "hari_id" => "5",
                "jam_id" => "5",
                "periode_id" => "5",
                "dosen_id" => "1",
            ],
            [
                "matakuliah_id" => "2",
                "hari_id" => "3",
                "jam_id" => "5",
                "periode_id" => "5",
                "dosen_id" => "1",
            ],
            [
                "matakuliah_id" => "3",
                "hari_id" => "4",
                "jam_id" => "5",
                "periode_id" => "5",
                "dosen_id" => "1",
            ],
            [
                "matakuliah_id" => "4",
                "hari_id" => "2",
                "jam_id" => "5",
                "periode_id" => "5",
                "dosen_id" => "1",
            ],
            [
                "matakuliah_id" => "5",
                "hari_id" => "1",
                "jam_id" => "5",
                "periode_id" => "5",
                "dosen_id" => "1",
            ],
        ];
        DB::table('kelas')->insert($list_kelas);
    }
}
