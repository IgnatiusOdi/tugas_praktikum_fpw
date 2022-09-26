<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $users = [
            ["ID" => 1, "Nama Lengkap" => "Ignatius Odi", "Username" => "odi", "Password" => "odi", "Jurusan" => "S1-INF", "Status" => "Mahasiswa"],
            ["ID" => 2, "Nama Lengkap" => "Aaron Linggo Satria", "Username" => "aaron", "Password" => "sayadosen", "Status" => "Dosen"]
        ];
        $username = $request["Username"];
        $password = $request["Password"];

        if ($username == "admin" && $password == "admin") {
            return redirect("admin-home", compact("users"));
        }

        foreach ($users as $user) {
            if ($user["Username"] == $username && $user["Password"] == $password) {
                $nama = $user["Nama Lengkap"];
                $jurusan = $user["Jurusan"];
                $status = $user["Status"];
                if ($status == "Mahasiswa") {
                    return redirect("mahasiswa-home", compact("nama", "jurusan", "status"));
                } else {
                    return redirect("dosen-home", compact("nama", "jurusan", "status"));
                }
            }
        }
    }
}
