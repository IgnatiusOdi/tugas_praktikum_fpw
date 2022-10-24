<?php

namespace App\Http\Controllers\Mahasiswa;

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

        return view("pages.mahasiswa.kelas", compact("url", "periode"));
    }

    public function detail(Request $request)
    {
        foreach (Session::get('listKelas') as $kelas) {
            if ($kelas['id'] == $request->detail) {
                $detail = $kelas;
                return view("pages.mahasiswa.detail", compact("detail"));
            }
        }
        return back()->with("message", "Gagal membuka detail kelas!");
    }
}
