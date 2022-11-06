<?php

namespace Database\Seeders;

use App\Models\Materi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Materi::insert([
            [
                "materi_minggu" => "1",
                "materi_judul" => "C++",
                "materi_deskripsi" => "-",
                "kelas_id" => "1",
            ],
            [
                "materi_minggu" => "2",
                "materi_judul" => "IF ELSE",
                "materi_deskripsi" => "-",
                "kelas_id" => "1",
            ],
            [
                "materi_minggu" => "3",
                "materi_judul" => "FOR",
                "materi_deskripsi" => "-",
                "kelas_id" => "1",
            ],
            [
                "materi_minggu" => "4",
                "materi_judul" => "3 Konstruksi Fundamental",
                "materi_deskripsi" => "-",
                "kelas_id" => "1",
            ],
            [
                "materi_minggu" => "5",
                "materi_judul" => "Array",
                "materi_deskripsi" => "-",
                "kelas_id" => "1",
            ],
        ]);
    }
}
