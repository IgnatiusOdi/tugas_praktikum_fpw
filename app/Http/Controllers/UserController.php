<?php

namespace App\Http\Controllers;

use App\Rules\RuleLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function viewLogin()
    {
        // Session::flush();
        Session::put("listUser", Session::get('listUser') ?? []);
        Session::put("listMataKuliah", Session::get('listMataKuliah') ?? []);
        Session::put("listPeriode", Session::get('listPeriode') ?? []);
        Session::put('periodeAktif', Session::get('periodeAktif') ?? []);
        Session::put("listKelas", Session::get('listKelas') ?? []);

        // dump(Session::get('listUser') ?? []);
        // dump(Session::get('listMataKuliah') ?? []);
        // dump(Session::get('listPeriode') ?? []);
        // dump(Session::get('periodeAktif') ?? []);
        // dump(Session::get('listKelas') ?? []);
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
        return back()->withInput()->withErrors(["password" => "Password salah!"]);
    }

    public function dummy()
    {
        Session::put("listUser", [
            [
                "username" => "220001",
                "nama" => "Ignatius Odi",
                "email" => "ignodi@odi.com",
                "nomor" => "1234123412",
                "tanggal" => "2002-05-21",
                "jurusan" => "INF",
                "tahun" => "2020",
                "password" => "Odi02",
                "role" => "mahasiswa"
            ],
            [
                "username" => "220002",
                "nama" => "Michael Kevin",
                "email" => "michaelkevin@mk.com",
                "nomor" => "1234432112",
                "tanggal" => "2002-12-25",
                "jurusan" => "SIB",
                "tahun" => "2020",
                "password" => "Kevin02",
                "role" => "mahasiswa"
            ],
            [
                "username" => "yosi_k",
                "nama" => "Yosi Kristian",
                "email" => "yosi@kris.com",
                "nomor" => "1231231231",
                "tanggal" => "1975-01-01",
                "jurusan" => "INF",
                "tahun" => "1995-01-01",
                "password" => "kristian",
                "role" => "dosen"
            ],
            [
                "username" => "ben_l",
                "nama" => "Benyamin Limanto",
                "email" => "ben@lim.com",
                "nomor" => "1233211233",
                "tanggal" => "1985-01-01",
                "jurusan" => "SIB",
                "tahun" => "2005-01-01",
                "password" => "limanto",
                "role" => "dosen"
            ]
        ]);
        Session::put("listMataKuliah", [
            [
                "kode" => "INFITP",
                "nama" => "Intro To Programming",
                "jurusan" => "INF",
                "semester" => "1",
                "sks" => "3"
            ],
            [
                "kode" => "INFPV",
                "nama" => "Pemrograman Visual",
                "jurusan" => "INF",
                "semester" => "3",
                "sks" => "3"
            ],
            [
                "kode" => "INFPW",
                "nama" => "Pemrograman Web",
                "jurusan" => "INF",
                "semester" => "3",
                "sks" => "3"
            ],
            [
                "kode" => "INFMDP",
                "nama" => "Mobile Device Programming",
                "jurusan" => "INF",
                "semester" => "5",
                "sks" => "3"
            ],
            [
                "kode" => "SIBMC",
                "nama" => "Mobile Computing",
                "jurusan" => "SIB",
                "semester" => "5",
                "sks" => "3"
            ]
        ]);
        Session::put("listPeriode", [
            [
                "tahun" => "2022-2023",
                "status" => "1"
            ]
        ]);
        Session::put('periodeAktif', [
            "2022-2023"
        ]);
        Session::put("listKelas", [
            [
                "id" => 1,
                "matakuliah" => "Intro To Programming",
                "jurusan" => "INF",
                "hari" => "Jumat",
                "jam" => "13:00",
                "periode" => "2022-2023",
                "dosen" => "Yosi Kristian",
                "mahasiswa" => [],
                "absensi" => []
            ],
            [
                "id" => 2,
                "matakuliah" => "Pemrograman Visual",
                "jurusan" => "INF",
                "hari" => "Rabu",
                "jam" => "10:30",
                "periode" => "2022-2023",
                "dosen" => "Yosi Kristian",
                "mahasiswa" => [],
                "absensi" => []
            ],
            [
                "id" => 3,
                "matakuliah" => "Mobile Device Programming",
                "jurusan" => "INF",
                "hari" => "Senin",
                "jam" => "13:00",
                "periode" => "2022-2023",
                "dosen" => "Yosi Kristian",
                "mahasiswa" => [],
                "absensi" => []
            ],
            [
                "id" => 4,
                "matakuliah" => "Mobile Computing",
                "jurusan" => "SIB",
                "hari" => "Selasa",
                "jam" => "15:00",
                "periode" => "2022-2023",
                "dosen" => "Benyamin Limanto",
                "mahasiswa" => [],
                "absensi" => []
            ]
        ]);

        return redirect()->route('login');
    }
}
