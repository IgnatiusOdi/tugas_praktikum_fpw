<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dosen::insert([
            [
                "dosen_username" => "yosi_k",
                "dosen_nama" => "Yosi Kristian",
                "dosen_email" => "yosi@k.com",
                "dosen_telepon" => "1111222233",
                "dosen_tanggal_lahir" => "1975-01-01",
                "jurusan_id" => "1",
                "dosen_kelulusan" => "1995-01-01",
                "dosen_password" => "kristian",
            ],
            [
                "dosen_username" => "ben_l",
                "dosen_nama" => "Benyamin Limanto",
                "dosen_email" => "ben@l.com",
                "dosen_telepon" => "2222333344",
                "dosen_tanggal_lahir" => "1985-01-01",
                "jurusan_id" => "2",
                "dosen_kelulusan" => "2005-01-01",
                "dosen_password" => "limanto",
            ],
            [
                "dosen_username" => "evan_k",
                "dosen_nama" => "Evan Kusuma Susanto",
                "dosen_email" => "evan@k.com",
                "dosen_telepon" => "3333444455",
                "dosen_tanggal_lahir" => "1995-01-01",
                "jurusan_id" => "1",
                "dosen_kelulusan" => "2015-01-01",
                "dosen_password" => "kusuma",
            ],
            [
                "dosen_username" => "mikhael_s",
                "dosen_nama" => "Mikhael Setiawan",
                "dosen_email" => "mikhael@s.com",
                "dosen_telepon" => "4444555566",
                "dosen_tanggal_lahir" => "1995-01-01",
                "jurusan_id" => "1",
                "dosen_kelulusan" => "2015-01-01",
                "dosen_password" => "setiawan",
            ],
            [
                "dosen_username" => "edwin_p",
                "dosen_nama" => "Edwin Pramana",
                "dosen_email" => "edwin@p.com",
                "dosen_telepon" => "5555666677",
                "dosen_tanggal_lahir" => "1965-01-01",
                "jurusan_id" => "1",
                "dosen_kelulusan" => "1985-01-01",
                "dosen_password" => "pramana",
            ],
        ]);
    }
}
