<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeriodeController extends Controller
{
    public function view()
    {
        return view('pages.admin.periode');
    }

    public function tambah(Request $request)
    {
        $tahun1 = $request->tahun1;
        $tahun2 = $request->tahun2;

        if (empty($tahun1) || empty($tahun2)) {
            return back()->with("message", "Field tidak boleh kosong!");
        } else if ($tahun1 >= $tahun2) {
            return back()->with("message", "Tahun 1 tidak boleh lebih besar atau sama dengan Tahun 2!");
        }

        Session::push('listPeriode', ["tahun" => $tahun1 . "/" . $tahun2, "status" => 0]);
        return back()->with("success", "Berhasil menambahkan periode!");
    }

    public function hapus(Request $request)
    {
        return back()->with("success", "Berhasil menghapus periode!");
    }
}
