<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        //CEK KOSONG
        if (empty($username) || empty($password)) {
            return redirect()->back()->with("message", "Field tidak boleh kosong!");
        }

        //ADMIN LOGIN
        if ($username == "admin" && $password == "admin") {
            return redirect()->route("admin-dashboard");
        }

        //CEK TERDAFTAR
        if (Session::has('listUser')) {
            foreach (Session::get("listUser") as $user) {
                //CEK USERNAME
                if ($user->username == $username) {
                    //CEK PASSWORD
                    if ($user->password == $password) {
                        if ($user->role == "Dosen") {
                            return redirect()->route("dosen-home");
                        } else {
                            return redirect()->route("mahasiswa-home");
                        }
                    } else {
                        return redirect()->back()->with("message", "Password salah!");
                    }
                }
            }
        }

        return redirect()->back()->with("message", "User tidak ditemukan!");
    }
}
