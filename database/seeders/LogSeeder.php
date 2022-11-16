<?php

namespace Database\Seeders;

use App\Models\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Log::insert([
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "Akses Home",
                "route_path" => "http://127.0.0.1:8000/mahasiswa",
                "ip_address" => "127.0.0.1",
                "status_code" => "200",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "Cari Profile",
                "route_path" => "http://127.0.0.1:8000/mahasiswa/find?nama=mikhael&role=mahasiswa",
                "ip_address" => "127.0.0.1",
                "status_code" => "200",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "Cari Profile",
                "route_path" => "http://127.0.0.1:8000/mahasiswa/find?nama=michael&role=mahasiswa",
                "ip_address" => "127.0.0.1",
                "status_code" => "302",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "Akses Home",
                "route_path" => "http://127.0.0.1:8000/mahasiswa",
                "ip_address" => "127.0.0.1",
                "status_code" => "200",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "Akses Kelas",
                "route_path" => "http://127.0.0.1:8000/mahasiswa/kelas",
                "ip_address" => "127.0.0.1",
                "status_code" => "500",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "Lihat Module",
                "route_path" => "http://127.0.0.1:8000/mahasiswa/module/1",
                "ip_address" => "127.0.0.1",
                "status_code" => "200",
            ],
        ]);
    }
}
