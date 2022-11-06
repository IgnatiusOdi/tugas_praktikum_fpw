<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matakuliah::insert([
            [
                "matakuliah_kode" => "INFITP",
                "matakuliah_nama" => "Intro To Programming",
                "jurusan_id" => "1",
                "matakuliah_semester" => "1",
                "matakuliah_sks" => "3"
            ],
            [
                "matakuliah_kode" => "INFPV",
                "matakuliah_nama" => "Pemrograman Visual",
                "jurusan_id" => "1",
                "matakuliah_semester" => "3",
                "matakuliah_sks" => "3",
            ],
            [
                "matakuliah_kode" => "INFPW",
                "matakuliah_nama" => "Pemrograman Web",
                "jurusan_id" => "1",
                "matakuliah_semester" => "3",
                "matakuliah_sks" => "3"
            ],
            [
                "matakuliah_kode" => "INFMDP",
                "matakuliah_nama" => "Mobile Device Programming",
                "jurusan_id" => "1",
                "matakuliah_semester" => "5",
                "matakuliah_sks" => "3"
            ],
            [
                "matakuliah_kode" => "SIBMC",
                "matakuliah_nama" => "Mobile Computing",
                "jurusan_id" => "2",
                "matakuliah_semester" => "5",
                "matakuliah_sks" => "3"
            ],
        ]);
    }
}
