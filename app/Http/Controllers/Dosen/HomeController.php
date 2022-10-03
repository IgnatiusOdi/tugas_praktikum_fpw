<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function view()
    {
        if (Session::has('dosen')) {
            return view("pages.dosen.home");
        } else {
            return redirect()->intended('login')->with("message", "Dosen belum login!");
        }
    }
}
