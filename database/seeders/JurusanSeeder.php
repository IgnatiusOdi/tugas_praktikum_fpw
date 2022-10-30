<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list_jurusan = [
            [
                "jurusan_kode" => "INF",
                "jurusan_nama" => "S1-Informatika",
            ],
            [
                "jurusan_kode" => "SIB",
                "jurusan_nama" => "S1-Sistem Informasi Bisnis",
            ],
            [
                "jurusan_kode" => "DKV",
                "jurusan_nama" => "S1-Desain Komunikasi Visual",
            ],
            [
                "jurusan_kode" => "DPR",
                "jurusan_nama" => "S1-Desain Produk",
            ],
            [
                "jurusan_kode" => "ELE",
                "jurusan_nama" => "S1-Elektro",
            ],
        ];
        DB::table('jurusan')->insert($list_jurusan);
    }
}
