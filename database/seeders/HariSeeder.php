<?php

namespace Database\Seeders;

use App\Models\Hari;
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
        Hari::insert([
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
        ]);
    }
}
