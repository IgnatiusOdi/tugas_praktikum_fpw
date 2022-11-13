<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function view()
    {
        $dosen = auth("guard_dosen")->user();
        return view("pages.dosen.home", compact("dosen"));
    }
}
