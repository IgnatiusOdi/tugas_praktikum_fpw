<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
