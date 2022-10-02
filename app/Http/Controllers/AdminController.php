<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboard()
    {
        $listPelajaran = [
            "Intro To Programming", "Object Orientation Programming", "Visual Programming", "Mobile Device Programming",
            "Intro To Web", "Database", "Web Programming", "Web Programming Framework"
        ];
        $listDosen = [
            ["Nama Lengkap" => "Aaron Linggo Satria", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["Nama Lengkap" => "Mikhael Chris", "Gender" => "Laki - laki", "Status" => "Cuti"],
            ["Nama Lengkap" => "Kenny", "Gender" => "Laki - laki", "Status" => "Cuti"],
        ];
        $listMahasiswa = [
            ["NIM" => "220116919", "Nama Lengkap" => "Ignatius Odi", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["NIM" => "220116920", "Nama Lengkap" => "Jason Kurniawan", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["NIM" => "220116921", "Nama Lengkap" => "John Louis Airlangga Wijaya", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["NIM" => "220110000", "Nama Lengkap" => "Budi Santoso", "Gender" => "Laki - laki", "Status" => "Cuti"],
        ];
        return view("pages.admin.dashboard", compact("listPelajaran", "listDosen", "listMahasiswa"));
    }

    public function dosen()
    {
        $listDosen = [
            ["Nama Lengkap" => "Aaron Linggo Satria", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["Nama Lengkap" => "Mikhael Chris", "Gender" => "Laki - laki", "Status" => "Cuti"],
            ["Nama Lengkap" => "Kenny", "Gender" => "Laki - laki", "Status" => "Cuti"],
        ];
        return view("pages.admin.dosen", compact("listDosen"));
    }

    public function mahasiswa()
    {
        $listMahasiswa = [
            ["NIM" => "220116919", "Nama Lengkap" => "Ignatius Odi", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["NIM" => "220116920", "Nama Lengkap" => "Jason Kurniawan", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["NIM" => "220116921", "Nama Lengkap" => "John Louis Airlangga Wijaya", "Gender" => "Laki - laki", "Status" => "Aktif"],
            ["NIM" => "220110000", "Nama Lengkap" => "Budi Santoso", "Gender" => "Laki - laki", "Status" => "Cuti"],
        ];
        return view("pages.admin.mahasiswa", compact("listMahasiswa"));
    }

    public function matakuliah()
    {
        Session::put('listMataKuliah', [
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
            ["kode" => "INFITP", "nama" => "Intro To Programming", "jurusan" => "S1-Informatika", "semester" => 1],
        ]);
        return view("pages.admin.matakuliah");
    }

    public function tambahMataKuliah() {

    }
}
