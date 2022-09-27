<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $username = $request["Username"];
        $password = $request["Password"];

        if ($username == "admin" && $password == "admin") {
            return redirect()->route("admin-dashboard");
        } else if ($username == "mhs" && $password == "mhs") {
            return redirect()->route("mahasiswa-home");
        } else if ($username == "dosen" && $password == "dosen") {
            return redirect()->route("dosen-home");
        } else {
            return redirect()->back();
        }

        // foreach ($users as $user) {
        //     if ($user["Username"] == $username && $user["Password"] == $password) {
        //         $nama = $user["Nama Lengkap"];
        //         $jurusan = $user["Jurusan"];
        //         $status = $user["Status"];
        //         if ($status == "Mahasiswa") {
        //             return redirect("mahasiswa-home", compact("nama", "jurusan", "status"));
        //         } else {
        //             return redirect("dosen-home", compact("nama", "status"));
        //         }
        //     }
        // }
    }
}
