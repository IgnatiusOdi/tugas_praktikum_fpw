<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::insert([
            [
                "mahasiswa_nrp" => "220001",
                "mahasiswa_nama" => "Ignatius Odi",
                "mahasiswa_email" => "ignatius@o.com",
                "mahasiswa_telepon" => "1111122222",
                "mahasiswa_tanggal_lahir" => "2002-05-21",
                "jurusan_id" => "1",
                "mahasiswa_angkatan" => "2020",
                "mahasiswa_password" => Hash::make("Odi02"),
            ],
            [
                "mahasiswa_nrp" => "220002",
                "mahasiswa_nama" => "Aaron Linggo Satria",
                "mahasiswa_email" => "aaron@ls.com",
                "mahasiswa_telepon" => "2222233333",
                "mahasiswa_tanggal_lahir" => "2002-01-01",
                "jurusan_id" => "1",
                "mahasiswa_angkatan" => "2020",
                "mahasiswa_password" => Hash::make("Satria02"),
            ],
            [
                "mahasiswa_nrp" => "220003",
                "mahasiswa_nama" => "Mikhael Chris",
                "mahasiswa_email" => "mikhael@c.com",
                "mahasiswa_telepon" => "3333344444",
                "mahasiswa_tanggal_lahir" => "2002-10-09",
                "jurusan_id" => "1",
                "mahasiswa_angkatan" => "2020",
                "mahasiswa_password" => Hash::make("Chris02"),
            ],
            [
                "mahasiswa_nrp" => "220004",
                "mahasiswa_nama" => "Samuel Gunawan Jagoan",
                "mahasiswa_email" => "samuel@gj.com",
                "mahasiswa_telepon" => "4444455555",
                "mahasiswa_tanggal_lahir" => "2002-07-01",
                "jurusan_id" => "1",
                "mahasiswa_angkatan" => "2020",
                "mahasiswa_password" => Hash::make("Jagoan02"),
            ],
            [
                "mahasiswa_nrp" => "220005",
                "mahasiswa_nama" => "Michael Kevin Wijaya",
                "mahasiswa_email" => "michael@kw.com",
                "mahasiswa_telepon" => "5555566666",
                "mahasiswa_tanggal_lahir" => "2002-12-25",
                "jurusan_id" => "1",
                "mahasiswa_angkatan" => "2020",
                "mahasiswa_password" => Hash::make("Wijaya02"),
            ],
        ]);
    }
}
