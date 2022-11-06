<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::insert([
            [
                "kelas_id" => 1,
                "module_nama" => "Tugas Minggu 1",
                "module_keterangan" => "Membaca Buku C++",
                "module_jenis" => "Assignment",
                "module_deadline" => "2022-11-10",
                "module_status" => 1,
            ],
            [
                "kelas_id" => 1,
                "module_nama" => "Tugas Minggu 2",
                "module_keterangan" => "IF ELSE STATEMENT",
                "module_jenis" => "Assignment",
                "module_deadline" => "2022-11-11",
                "module_status" => 1,
            ],
            [
                "kelas_id" => 1,
                "module_nama" => "Tugas Minggu 3",
                "module_keterangan" => "FOR LOOP",
                "module_jenis" => "Assignment",
                "module_deadline" => "2022-11-12",
                "module_status" => 1,
            ],
            [
                "kelas_id" => 1,
                "module_nama" => "Tugas Minggu 4",
                "module_keterangan" => "3 Konstruksi Fundamental",
                "module_jenis" => "Quiz",
                "module_deadline" => "2022-11-13",
                "module_status" => 1,
            ],
            [
                "kelas_id" => 1,
                "module_nama" => "Tugas Minggu 5",
                "module_keterangan" => "Array",
                "module_jenis" => "Assignment",
                "module_deadline" => "2022-11-14",
                "module_status" => 1,
            ],
        ]);
    }
}
