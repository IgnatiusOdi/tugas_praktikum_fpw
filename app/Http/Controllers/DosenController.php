<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function register()
    {
        $title = "REGISTER | DOSEN";
        return view('pages.dosen.register', compact("title"));
    }

    public function tryRegister() {

    }

    public function home()
    {
        $listPelajaran = [
            "Intro To Programming", "Object Orientation Programming", "Visual Programming", "Mobile Device Programming",
            "Intro To Web", "Database", "Web Programming", "Web Programming Framework"
        ];
        $nama = "NAMA";
        $status = "AKTIF";
        return view("pages.dosen.home", compact("nama", "listPelajaran", "status"));
    }

    public function profile($nama = "NAMA", $status = "AKTIF")
    {
        $nama = strtoupper($nama);
        $status = strtoupper($status);
        return view("pages.dosen.profile", compact("nama", 'status'));
    }
}
