<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function view(Request $request)
    {
        $url = $request->segment(3);
        $periode = "";
        if (isset($url)) {
            $listPeriode = explode('-', $url);
            $periode = $listPeriode[0] . "/" . $listPeriode[1];
        }

        return view("pages.dosen.kelas", compact("url", "periode"));
    }

    public function detail(Request $request)
    {
        foreach (Session::get('listKelas') as $kelas) {
            if ($kelas['id'] == $request->id) {
                $detail = $kelas;
                return view("pages.dosen.detail", compact("detail"));
            }
        }
        return back()->with("message", "Gagal membuka detail kelas!");
    }

    public function absensi(Request $request)
    {
        foreach (Session::get('listKelas') as $kelas) {
            if ($kelas['id'] == $request->id) {
                $detail = $kelas;
                return view("pages.dosen.absensi", compact("detail"));
            }
        }
        return back()->with("message", "Gagal membuka absensi!");
    }

    public function create(Request $request)
    {
        $request->validate([
            "minggu" => "required | integer | min:1 | max:14",
            "materi" => "required",
            "deskripsi" => "required",
        ]);

        $kelas = Session::get('listKelas');
        array_push($kelas[$request->id - 1]['absensi'], [
            "minggu" => $request->minggu,
            "materi" => $request->materi,
            "deskripsi" => $request->deskripsi,
            "hadir" => $request->hadir ?? []
        ]);

        Session::put('listKelas', $kelas);

        foreach (Session::get('listKelas') as $kelas) {
            if ($kelas['id'] == $request->id) {
                $detail = $kelas;
                $id = $detail['id'];
                return redirect()->route('dosen-kelas-detail', compact("id"))->with("success", "Berhasil membuat absensi!");
            }
        }
    }
}
