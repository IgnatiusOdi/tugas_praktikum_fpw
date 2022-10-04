<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $nama = $request->nama;
        $jurusan = $request->jurusan;
        $semester = $request->semester;

        //CEK FIELD KOSONG
        if (empty($nama) || empty($semester)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }

        //CREATE KODE
        $words = explode(' ', $nama);
        $kode = $jurusan;
        if (count($words) > 1) {
            foreach ($words as $initial) {
                $kode .= $initial[0];
            }
        } else {
            $kode .= $words[0][0] . $words[0][1];
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
                    Session::put('listMataKuliah', $listMataKuliah);
                    return back()->with("success", "Berhasil menghapus mata kuliah!");
                }
            }
        }
        return back()->with("message", "Gagal menghapus mata kuliah!");
    }
}
