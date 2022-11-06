<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function viewLogin()
    {
        // Session::flush();
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $request->validate(
            [
                "username" => "required",
                "password" => "required",
            ],
            [
                "required" => "Field wajib diisi!",
            ]
        );

        //ADMIN LOGIN
        if ($username == "admin" && $password == "admin") {
            Session::put('admin', true);
            return redirect()->route("admin");
        }

        $mahasiswa = Mahasiswa::where('mahasiswa_nrp', $username)->first();
        if ($mahasiswa) {
            // CEK PASSWORD
            if ($password == $mahasiswa->mahasiswa_password) {
                Session::put('mahasiswa', $mahasiswa);
                return redirect()->route('mahasiswa');
            } else {
                return back()->withInput()->withErrors(["password" => "Password salah!"]);
            }
        }

        $dosen = Dosen::where('dosen_username', $username)->first();
        if ($dosen) {
            // CEK PASSWORD
            if ($password == $dosen->dosen_password) {
                Session::put('dosen', $dosen);
                return redirect()->route('dosen');
            } else {
                return back()->withInput()->withErrors(["password" => "Password salah!"]);
            }
        }

        // JIKA TIDAK ADA, BERARTI TIDAK TERDAFTAR
        return back()->withInput()->withErrors(["username" => "User tidak terdaftar!"]);
    }
}
