<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function view()
    {
        // Session::put('listKelas', []);
        return view("pages.admin.kelas");
    }

    public function tambah(Request $request)
    {
        $request->validate(
            [
                "matakuliah" => "required",
                "sks" => "required | integer | gte:2",
                "hari" => "required",
                "jam" => "required",
                "periode" => "required",
                "dosen" => "required",
            ],
            [
                "required" => "Field harus diisi!",
                "gte" => "Minimal SKS adalah 2"
            ]
        );

        $matakuliah = explode('-', $request->matakuliah);
        $dosen = explode('-', $request->dosen);

        $namaMatkul = $matakuliah[0];
        $jurusanMatkul = $matakuliah[1];
        $namaDosen = $dosen[0];
        $jurusanDosen = $dosen[1];

        Session::push("listKelas", [
            "matakuliah" => $namaMatkul,
            "sks" => $request->sks,
            "hari" => $request->hari,
            "jam" => $request->jam,
            "periode" => $request->periode,
            "dosen" => $namaDosen,
        ]);
        return back()->with("success", "Berhasil menambahkan kelas!");
    }

    public function hapus(Request $request)
    {
        if (isset($request->matakuliah)) {
            $listKelas = Session::get('listKelas');
            foreach ($listKelas as $key => $kelas) {
                if ($kelas['matakuliah'] == $request->matakuliah) {
                    unset($listKelas[$key]);
                    Session::put('listKelas', $listKelas);
                    return back()->with("success", "Berhasil menghapus kelas!");
                }
            }
        }
        return back()->with("message", "Gagal menghapus kelas!");
    }
}
