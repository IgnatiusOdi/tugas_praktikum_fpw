<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelasMahasiswa = [
            [
                "kelas_id" => 1,
                "mahasiswa_id" => 1,
            ],
            [
                "kelas_id" => 1,
                "mahasiswa_id" => 2,
            ],
            [
                "kelas_id" => 1,
                "mahasiswa_id" => 3,
            ],
            [
                "kelas_id" => 1,
                "mahasiswa_id" => 4,
            ],
            [
                "kelas_id" => 5,
                "mahasiswa_id" => 5,
            ]
        ];
        DB::table('kelas_mahasiswa')->insert($kelasMahasiswa);
    }
}
