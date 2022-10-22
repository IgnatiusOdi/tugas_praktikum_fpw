<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\RuleMataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MataKuliahController extends Controller
{
    public function view()
    {
        // Session::put('listMataKuliah', []);
        return view("pages.admin.matakuliah");
    }

    public function tambah(Request $request)
    {
        if ($request->button == "Tambah") {
            $request->validate(
                [
                    "nama" => ["required", new RuleMataKuliah(Session::get('listMataKuliah'))],
                    "jurusan" => "required",
                    "semester" => "required | integer | between:1,8",
                    "sks" => "required | integer | gte:2",
                ],
                [
                    "required" => "Field harus diisi!",
                    "between" => "Minimal semester harus antara semester 1 hingga 8",
                    "gte" => "Minimal SKS adalah 2",
                ]
            );

            //CREATE KODE
            $words = explode(' ', strtoupper($request->nama));
            $kode = $request->jurusan;
            if (count($words) > 1) {
                foreach ($words as $initial) {
                    $kode .= $initial[0];
                }
            } else {
                $kode .= $words[0][0] . $words[0][1];
            }

            Session::push("listMataKuliah", [
                "kode" => $kode,
                "nama" => $request->nama,
                "jurusan" => $request->jurusan,
                "semester" => $request->semester,
                "sks" => $request->sks,
            ]);

            return back()->with("success", "Berhasil menambahkan mata kuliah!");
        } else {
            $request->validate(
                [
                    "nama" => ["required"],
                    "semester" => "required | integer | between:1,8",
                    "sks" => "required | integer | gte:2",
                ],
                [
                    "required" => "Field harus diisi!",
                    "between" => "Minimal semester harus antara semester 1 hingga 8",
                    "gte" => "Minimal SKS adalah 2",
                ]
            );

            $listMataKuliah = Session::get('listMataKuliah');
            foreach ($listMataKuliah as $key => $matkul) {
                if ($matkul["kode"] == $request->kode) {
                    $matkul["nama"] = $request->nama;
                    $matkul["semester"] = $request->semester;
                    $matkul["sks"] = $request->sks;
                    $listMataKuliah[$key] = $matkul;
                    Session::put('listMataKuliah', $listMataKuliah);
                    Session::forget("editMatkul");
                    return back()->with("success", "Berhasil mengedit mata kuliah!");
                }
            }
        }
        return back()->with("message", "Gagal menambah / mengedit mata kuliah!");
    }

    public function action(Request $request)
    {
        if (isset($request->edit)) {
            $listMataKuliah = Session::get('listMataKuliah');
            foreach ($listMataKuliah as $key => $matkul) {
                if ($matkul['kode'] == $request->edit) {
                    Session::put("editMatkul", $matkul);
                    return back();
                }
            }
        } else if (isset($request->delete)) {
            $listMataKuliah = Session::get('listMataKuliah');
            foreach ($listMataKuliah as $key => $matkul) {
                if ($matkul['kode'] == $request->delete) {
                    unset($listMataKuliah[$key]);
                    Session::put('listMataKuliah', $listMataKuliah);
                    return back()->with("success", "Berhasil menghapus mata kuliah!");
                }
            }
        }
        return back()->with("message", "Gagal menghapus mata kuliah!");
    }
}
