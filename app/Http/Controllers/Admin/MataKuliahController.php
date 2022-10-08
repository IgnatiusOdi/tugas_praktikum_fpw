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
        $request->validate(
            [
                "nama" => ["required", new RuleMataKuliah(Session::get('listMataKuliah'))],
                "jurusan" => "required",
                "semester" => "required | integer | between:1,8",
            ],
            [
                "required" => "Field harus diisi!",
                "between" => "Minimal semester harus antara semester 1 hingga 8",
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

        Session::push("listMataKuliah", ["kode" => $kode, "nama" => $request->nama, "jurusan" => $request->jurusan, "semester" => $request->semester]);
        return back()->with("success", "Berhasil menambahkan mata kuliah!");
    }

    public function hapus(Request $request)
    {
        if (isset($request->kode)) {
            $listMataKuliah = Session::get('listMataKuliah');
            foreach ($listMataKuliah as $key => $matkul) {
                if ($matkul['kode'] == $request->kode) {
                    unset($listMataKuliah[$key]);
                    Session::put('listMataKuliah', $listMataKuliah);
                    return back()->with("success", "Berhasil menghapus mata kuliah!");
                }
            }
        }
        return back()->with("message", "Gagal menghapus mata kuliah!");
    }
}
