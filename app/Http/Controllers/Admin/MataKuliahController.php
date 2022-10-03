<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MataKuliahController extends Controller
{
    public function view()
    {
        return view("pages.admin.matakuliah");
    }

    public function tambah(Request $request)
    {
        $nama = $request->nama;
        $jurusan = $request->jurusan;
        $semester = $request->semester;

        if (empty($nama) || empty($semester)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }

        $words = explode(' ', $nama);
        $kode = $jurusan;
        if (count($words) > 1) {
            foreach ($words as $initial) {
                $kode .= $initial[0];
            }
        } else {
            $kode .= $words[0][0] . $words[0][1];
        }
        if ($jurusan == "INF") {
            $jurusan = "S1-Informatika";
        } else if ($jurusan == "SIB") {
            $jurusan = "S1-Sistem Informasi Bisnis";
        } else if ($jurusan == "DKV") {
            $jurusan = "S1-Desain Komunikasi Visual";
        }

        Session::push("listMataKuliah", ["kode" => $kode, "nama" => $nama, "jurusan" => $jurusan, "semester" => $semester]);
        return back()->with("success", "Berhasil menambahkan mata kuliah!");
    }

    public function hapus(Request $request)
    {
        if (isset($request->kode)) {
            $listMataKuliah = Session::get('listMataKuliah');
            foreach ($listMataKuliah as $key => $matkul) {
                if ($matkul['kode'] == $request->kode) {
                    unset($listMataKuliah[$key]);
                    break;
                }
            }
            Session::put('listMataKuliah', $listMataKuliah);
        }
        return back()->with("success", "Berhasil menghapus mata kuliah!");
    }
}
