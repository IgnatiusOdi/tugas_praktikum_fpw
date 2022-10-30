<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_absensi = [
            [
                "materi_id" => "1",
                "mahasiswa_id" => "1",
                "absensi_status" => true,
            ],
            [
                "materi_id" => "2",
                "mahasiswa_id" => "1",
                "absensi_status" => true,
            ],
            [
                "materi_id" => "3",
                "mahasiswa_id" => "1",
                "absensi_status" => true,
            ],
            [
                "materi_id" => "4",
                "mahasiswa_id" => "1",
                "absensi_status" => false,
            ],
            [
                "materi_id" => "5",
                "mahasiswa_id" => "1",
                "absensi_status" => true,
            ],
        ];
        DB::table('absensi')->insert($list_absensi);
    }
}
