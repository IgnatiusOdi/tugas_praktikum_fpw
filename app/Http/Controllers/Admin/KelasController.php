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
        if ($request->button == "Tambah") {
            $request->validate(
                [
                    "matakuliah" => "required",
                    "hari" => "required",
                    "jam" => "required",
                    "periode" => "required",
                    "dosen" => "required",
                ],
                [
                    "required" => "Field harus diisi!",
                ]
            );

            $matakuliah = explode('-', $request->matakuliah);
            $dosen = explode('-', $request->dosen);

            $namaMatkul = $matakuliah[0];
            $jurusanMatkul = $matakuliah[1];
            $namaDosen = $dosen[0];
            $jurusanDosen = $dosen[1];

            $id = count(Session::get('listKelas')) + 1;

            Session::push("listKelas", [
                "id" => $id,
                "matakuliah" => $namaMatkul,
                "jurusan" => $jurusanMatkul,
                "hari" => $request->hari,
                "jam" => $request->jam,
                "periode" => $request->periode,
                "dosen" => $namaDosen,
                "mahasiswa" => [],
                "absensi" => [],
            ]);

            return back()->with("success", "Berhasil menambahkan kelas!");
        } else {
            $request->validate(
                [
                    "matakuliah" => "required",
                    "hari" => "required",
                    "jam" => "required",
                    "periode" => "required",
                ],
                [
                    "required" => "Field harus diisi!",
                ]
            );

            $matakuliah = explode('-', $request->matakuliah);
            $dosen = explode('-', $request->dosen);

            $namaMatkul = $matakuliah[0];
            $jurusanMatkul = $matakuliah[1];

            $listKelas = Session::get('listKelas');
            foreach ($listKelas as $key => $kelas) {
                if ($kelas["id"] == $request->id) {
                    $kelas["matakuliah"] = $namaMatkul;
                    $kelas["hari"] = $request->hari;
                    $kelas["jam"] = $request->jam;
                    $kelas["periode"] = $request->periode;
                    $listKelas[$key] = $kelas;
                    Session::put('listKelas', $listKelas);
                    Session::forget("editKelas");
                    return back()->with("success", "Berhasil mengedit kelas!");
                }
            }
        }
        return back()->with("message", "Gagal menambah / mengedit kelas!");
    }

    public function action(Request $request)
    {
        if (isset($request->edit)) {
            $listKelas = Session::get('listKelas');
            foreach ($listKelas as $key => $kelas) {
                if ($kelas['id'] == $request->edit) {
                    Session::put("editKelas", $kelas);
                    return back();
                }
            }
        } else if (isset($request->delete)) {
            $listKelas = Session::get('listKelas');
            foreach ($listKelas as $key => $kelas) {
                if ($kelas['id'] == $request->delete) {
                    unset($listKelas[$key]);
                    Session::put('listKelas', $listKelas);
                    return back()->with("success", "Berhasil menghapus kelas!");
                }
            }
        }
        return back()->with("message", "Gagal menghapus kelas!");
    }
}
