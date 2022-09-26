<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        return view("pages.admin.home");
    }

    public function dosen()
    {
        return view("pages.admin.dosen");
    }

    public function mahasiswa()
    {
        return view("pages.admin.mahasiswa");
    }
}
