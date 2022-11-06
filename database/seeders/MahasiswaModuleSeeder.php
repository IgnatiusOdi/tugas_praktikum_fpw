<?php

namespace Database\Seeders;

use App\Models\MahasiswaModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MahasiswaModule::insert([
            [
                "module_id" => 1,
                "mahasiswa_id" => 1,
                "module_jawaban" => "Hello World!",
                "created_at" => now(),
            ],
            [
                "module_id" => 1,
                "mahasiswa_id" => 2,
                "module_jawaban" => "Hello World!",
                "created_at" => now(),
            ],
            [
                "module_id" => 1,
                "mahasiswa_id" => 3,
                "module_jawaban" => "Hello World!",
                "created_at" => now(),
            ],
            [
                "module_id" => 1,
                "mahasiswa_id" => 4,
                "module_jawaban" => "Hello World!",
                "created_at" => now(),
            ],
            [
                "module_id" => 2,
                "mahasiswa_id" => 1,
                "module_jawaban" => "Hello World!",
                "created_at" => now(),
            ],
        ]);
    }
}
