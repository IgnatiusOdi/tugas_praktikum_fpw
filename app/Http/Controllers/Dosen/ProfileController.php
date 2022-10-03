<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function view()
    {
        return view("pages.dosen.profile");
    }

    public function edit(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $nomor = $request->nomor;
        $password = $request->password;

        // foreach (Session::get('listDosen') as $dosen) {
        //     if ($dosen['username'] == $username) {
        //         return back()->withInput($request->input())->with("message", "Username harus unique!");
        //     } else if ($dosen['email'] == $email) {
        //         return back()->withInput($request->input())->with("message", "Email harus unique!");
        //     } else if ($dosen['nomor'] == $nomor) {
        //         return back()->withInput($request->input())->with("message", "Nomor telepon harus unique!");
        //     }
        // }

        return back()->with("message", "Gagal edit profile!");
        return back()->with("success", "Berhasil edit profile!");
    }
}
