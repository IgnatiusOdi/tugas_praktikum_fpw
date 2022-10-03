<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function view()
    {
        return view("pages.admin.kelas");
    }

    public function tambah(Request $request)
    {
        $matakuliah = $request->matakuliah;
        $hari = $request->hari;
        $jam = $request->jam;
        $periode = $request->periode;
        $dosen = $request->dosen;

        if (empty($matakuliah) || empty($periode) || empty($dosen)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }

        //TODO
        //CEK DOSEN SAMA

        Session::push("listKelas", ["matakuliah" => $matakuliah, "hari" => $hari, "jam" => $jam, "periode" => $periode, "dosen" => $dosen]);
        return back()->with("success", "Berhasil menambahkan kelas!");
    }

    public function hapus(Request $request)
    {
        if (isset($request->matakuliah)) {
            $listKelas = Session::get('listKelas');
            foreach ($listKelas as $key => $kelas) {
                if ($kelas['matakuliah'] == $request->matakuliah) {
                    unset($listKelas[$key]);
                    break;
                }
            }
            Session::put('listKelas', $listKelas);
        }
        return back()->with("success", "Berhasil menghapus kelas!");
    }
}
