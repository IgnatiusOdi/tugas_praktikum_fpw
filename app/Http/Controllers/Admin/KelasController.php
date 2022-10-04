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
        $matakuliah = explode('-', $request->matakuliah);
        $hari = $request->hari;
        $jam = $request->jam;
        $periode = $request->periode;
        $dosen = explode('-', $request->dosen);

        //CEK FIELD KOSONG
        if (empty($matakuliah) || empty($periode) || empty($dosen)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }

        $namaMatkul = $matakuliah[0];
        $jurusanMatkul = $matakuliah[1];
        $namaDosen = $dosen[0];
        $jurusanDosen = $dosen[1];

        //CEK DOSEN JURUSAN SAMA
        if ($jurusanMatkul != $jurusanDosen) {
            return back()->with("message", "Jurusan Dosen dan Jurusan Mata Kuliah harus sama!");
        }

        Session::push("listKelas", ["matakuliah" => $namaMatkul, "hari" => $hari, "jam" => $jam, "periode" => $periode, "dosen" => $namaDosen]);
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
