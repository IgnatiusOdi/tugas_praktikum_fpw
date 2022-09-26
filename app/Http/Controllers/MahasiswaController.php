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
        return view("pages.mahasiswa.home");
    }

    public function profile()
    {
        return view("pages.mahasiswa.profile");
    }
}
