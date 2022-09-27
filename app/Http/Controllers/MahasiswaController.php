<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function register()
    {
        $title = "REGISTER | MAHASISWA";
        return view('pages.mahasiswa.register', compact("title"));
    }

    public function home($nama = "NAMA", $nim = "NIM", $status = "AKTIF")
    {
        $nama = strtoupper($nama);
        $nim = strtoupper($nim);
        $status = strtoupper($status);
        return view("pages.mahasiswa.home", compact("nama", "nim", "status"));
    }

    public function profile($nama = "NAMA", $nim = "NIM", $status = "AKTIF")
    {
        $nama = strtoupper($nama);
        $nim = strtoupper($nim);
        $status = strtoupper($status);
        return view("pages.mahasiswa.profile", compact("nama", "nim", "status"));
    }
}
