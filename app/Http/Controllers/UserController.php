<?php

namespace App\Http\Controllers;

use App\Rules\CekTerdaftar;
use App\Rules\RuleLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function viewLogin()
    {
        // Session::flush();
        $listUser = Session::get('listUser') ?? [];
        Session::put("listUser", $listUser);
        $listMataKuliah = Session::get('listMataKuliah') ?? [];
        Session::put("listMataKuliah", $listMataKuliah);
        $listPeriode = Session::get('listPeriode') ?? [];
        Session::put("listPeriode", $listPeriode);
        $periodeAktif = Session::get('periodeAktif') ?? [];
        Session::put('periodeAktif', $periodeAktif);
        $listKelas = Session::get('listKelas') ?? [];
        Session::put("listKelas", $listKelas);

        dump($listUser);
        dump($listMataKuliah);
        dump($listPeriode);
        dump($periodeAktif);
        dump($listKelas);
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                "username" => ["required", new RuleLogin(Session::get('listUser'))],
                "password" => "required",
            ],
            [
                "required" => "Field wajib diisi!",
            ]
        );

        $username = $request->username;
        $password = $request->password;

        //ADMIN LOGIN
        if ($username == "admin" && $password == "admin") {
            Session::put('admin', true);
            return redirect()->route("admin");
        }

        //CEK USER LOGIN
        foreach (Session::get('listUser') as $user) {
            //CEK USERNAME
            if ($user['username'] == $username) {
                //CEK PASSWORD
                if ($user['password'] == $password) {
                    //CEK ROLE
                    if ($user['role'] == "dosen") {
                        Session::put('dosen', $user);
                        return redirect()->route("dosen");
                    } else {
                        Session::put('mahasiswa', $user);
                        return redirect()->route('mahasiswa');
                    }
                }
            }
        }

        //JIKA TIDAK ADA, BERARTI PASSWORD SALAH
        return back()->withErrors(["password" => "Password salah!"]);
    }
}
