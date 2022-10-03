<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function viewLogin()
    {
        // Session::flush();
        $listMahasiswa = Session::get('listMahasiswa') ?? [];
        Session::put("listMahasiswa", $listMahasiswa);
        $listDosen = Session::get('listDosen') ?? [];
        Session::put("listDosen", $listDosen);
        $listMataKuliah = Session::get('listMataKuliah') ?? [];
        Session::put("listMataKuliah", $listMataKuliah);
        $listPeriode = Session::get('listPeriode') ?? [];
        Session::put("listPeriode", $listPeriode);
        $listKelas = Session::get('listKelas') ?? [];
        Session::put("listKelas", $listKelas);

        dump($listMahasiswa);
        dump($listDosen);
        dump($listMataKuliah);
        dump($listPeriode);
        dump($listKelas);
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        //CEK KOSONG
        if (empty($username) || empty($password)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }

        //ADMIN LOGIN
        if ($username == "admin" && $password == "admin") {
            Session::put('admin', true);
            return redirect()->route("admin");
        }

        //CEK TERDAFTAR DOSEN
        if (Session::has('listDosen')) {
            foreach (Session::get("listDosen") as $dosen) {
                //CEK USERNAME
                if ($dosen['username'] == $username) {
                    //CEK PASSWORD
                    if ($dosen['password'] == $password) {
                        Session::put('dosen', $dosen);
                        return redirect()->route("dosen");
                    } else {
                        return back()->with("message", "Password salah!");
                    }
                }
            }
        }

        //CEK TERDAFTAR MAHASISWA
        if (Session::has('listMahasiswa')) {
            foreach (Session::get("listMahasiswa") as $mahasiswa) {
                //CEK USERNAME
                if ($mahasiswa['nrp'] == $username) {
                    //CEK PASSWORD
                    if ($mahasiswa['password'] == $password) {
                        Session::put('mahasiswa', $mahasiswa);
                        return redirect()->route("mahasiswa");
                    } else {
                        return back()->with("message", "Password salah!");
                    }
                }
            }
        }

        return back()->with("message", "User tidak terdaftar!");
    }
}
