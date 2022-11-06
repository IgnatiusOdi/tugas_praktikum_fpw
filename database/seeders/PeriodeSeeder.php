<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periode::insert([
            [
                "periode_tahun" => "2018/2019",
                "periode_status" => "0",
            ],
            [
                "periode_tahun" => "2019/2020",
                "periode_status" => "0",
            ],
            [
                "periode_tahun" => "2020/2021",
                "periode_status" => "0",
            ],
            [
                "periode_tahun" => "2021/2022",
                "periode_status" => "0",
            ],
            [
                "periode_tahun" => "2022/2023",
                "periode_status" => "1",
            ],
        ]);
    }
}
