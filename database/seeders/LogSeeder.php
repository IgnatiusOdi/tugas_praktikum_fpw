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
                "keterangan" => "login",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "logout",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "login",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "logout",
            ],
            [
                "user_id" => 1,
                "role" => "mahasiswa",
                "keterangan" => "login",
            ],
        ]);
    }
}
