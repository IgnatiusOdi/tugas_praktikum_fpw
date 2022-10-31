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
                "mahasiswa_status" => 1,
            ],
            [
                "kelas_id" => 1,
                "mahasiswa_id" => 2,
                "mahasiswa_status" => 1,
            ],
            [
                "kelas_id" => 1,
                "mahasiswa_id" => 3,
                "mahasiswa_status" => 1,
            ],
            [
                "kelas_id" => 1,
                "mahasiswa_id" => 4,
                "mahasiswa_status" => 1,
            ],
            [
                "kelas_id" => 2,
                "mahasiswa_id" => 1,
                "mahasiswa_status" => 0,
            ]
        ];
        DB::table('kelas_mahasiswa')->insert($kelasMahasiswa);
    }
}
