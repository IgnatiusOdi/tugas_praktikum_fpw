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

    public function home()
    {
        $listPelajaran = [
            "Intro To Programming", "Object Orientation Programming", "Visual Programming", "Mobile Device Programming",
            "Intro To Web", "Database", "Web Programming", "Web Programming Framework"
        ];
        $nama = "NAMA";
        $status = "AKTIF";
        return view("pages.mahasiswa.home", compact("nama", "listPelajaran", "status"));
    }

    public function profile($nama = "NAMA", $nim = "NIM", $status = "AKTIF")
    {
        $nama = strtoupper($nama);
        $nim = strtoupper($nim);
        $status = strtoupper($status);
        return view("pages.mahasiswa.profile", compact("nama", "nim", "status"));
    }
}
