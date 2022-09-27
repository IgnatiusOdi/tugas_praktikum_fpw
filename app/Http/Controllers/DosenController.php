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

    public function home($nama = "NAMA", $status = "AKTIF")
    {
        $nama = strtoupper($nama);
        $status = strtoupper($status);
        return view("pages.dosen.home", compact("nama", 'status'));
    }

    public function profile($nama = "NAMA", $status = "AKTIF")
    {
        $nama = strtoupper($nama);
        $status = strtoupper($status);
        return view("pages.dosen.profile", compact("nama", 'status'));
    }
}
