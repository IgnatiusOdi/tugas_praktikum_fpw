<?php

namespace Database\Seeders;

use App\Models\Pengumuman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengumuman::insert([
            [
                "kelas_id" => "1",
                "pengumuman_deskripsi" => "Pengumuman Minggu 1",
                "pengumuman_link" => "",
            ],
            [
                "kelas_id" => "1",
                "pengumuman_deskripsi" => "Pengumuman Minggu 2",
                "pengumuman_link" => "",
            ],
            [
                "kelas_id" => "1",
                "pengumuman_deskripsi" => "Pengumuman Minggu 3",
                "pengumuman_link" => "",
            ],
            [
                "kelas_id" => "1",
                "pengumuman_deskripsi" => "Pengumuman Minggu 4",
                "pengumuman_link" => "",
            ],
            [
                "kelas_id" => "1",
                "pengumuman_deskripsi" => "Pengumuman Minggu 5",
                "pengumuman_link" => "",
            ],
        ]);
    }
}
