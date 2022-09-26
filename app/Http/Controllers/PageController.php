<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function redirectToLogin()
    {
        return redirect('login');
    }

    public function login()
    {
        $title = "LOGIN";
        return view('login', compact("title"));
    }
}
