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

        $credentials = [
            "mahasiswa_nrp" => $username,
            "password" => $password,
        ];

        //ADMIN LOGIN
        if ($username == "admin" && $password == "admin") {
            Session::put('admin', true);
            return redirect()->route("admin");
        }

        //MAHASISWA
        if (auth('guard_mahasiswa')->attempt($credentials)) {
            return redirect()->route('mahasiswa');
        } else {
            //DOSEN
            $credentials = [
                "dosen_username" => $username,
                "password" => $password,
            ];
            if (auth('guard_dosen')->attempt($credentials)) {
                return redirect()->route('dosen');
            }
        }
        return back()->withInput()->with("message", "Gagal login!");
    }
}
