<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view()
    {
        return view("pages.mahasiswa.profile");
    }

    public function edit()
    {
        return back()->with("message", "Gagal edit profile!");
        return back()->with("success", "Berhasil edit profile!");
    }
}
