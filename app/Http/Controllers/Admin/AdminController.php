<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function view()
    {
        if (Session::has('admin')) {
            return view("pages.admin.dashboard");
        } else {
            return redirect()->intended('login')->with("message", "Admin belum login!");
        }
    }
}
