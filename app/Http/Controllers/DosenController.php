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

    public function home(Request $request)
    {
        $title = "HOME | " . $request;
        return view("pages.dosen.home", compact("title"));
    }

    public function profile(Request $request)
    {
        $title = "PROFILE | " . $request;
        return view("pages.dosen.profile", compact("title"));
    }
}
