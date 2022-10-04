<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function view()
    {
        if (Session::has('mahasiswa')) {
            return view("pages.mahasiswa.home");
        } else {
            return redirect()->intended('login')->with("message", "Mahasiswa belum login!");
        }
    }
}
