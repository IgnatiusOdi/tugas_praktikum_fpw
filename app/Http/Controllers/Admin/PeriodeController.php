<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PeriodeController extends Controller
{
    public function view()
    {
        // Session::put('listPeriode', []);
        return view('pages.admin.periode');
    }

    public function tambah(Request $request)
    {
        $tahun1 = $request->tahun1;
        $tahun2 = $request->tahun2;

        //CEK FIELD KOSONG
        if (empty($tahun1) || empty($tahun2)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }
        //CEK TAHUN 1 >= TAHUN 2
        else if ($tahun1 >= $tahun2) {
            return back()->with("message", "Tahun 1 tidak boleh lebih besar atau sama dengan Tahun 2!");
        }

        Session::push('listPeriode', ["tahun" => $tahun1 . "-" . $tahun2, "status" => 0]);
        return back()->with("success", "Berhasil menambahkan periode!");
    }

    public function action(Request $request)
    {
        $listPeriode = Session::get('listPeriode');
        $periodeAktif = Session::get('periodeAktif');

        //CHANGE STATUS
        if (isset($request->change)) {
            //CARI PERIODE
            foreach ($listPeriode as $key => $periode) {
                if ($periode['tahun'] == $request->tahun) {
                    if ($periode['status'] == 0) {
                        $periode['status'] = 1;
                        Session::push('periodeAktif', $periode['tahun']);
                    } else {
                        $periode['status'] = 0;
                        foreach ($periodeAktif as $keyAktif => $aktif) {
                            if ($aktif == $periode['tahun']) {
                                unset($periodeAktif[$keyAktif]);
                                Session::put('periodeAktif', $periodeAktif);
                            }
                        }
                    }
                    $listPeriode[$key]['status'] = $periode['status'];
                    Session::put('listPeriode', $listPeriode);
                    return back()->with("success", "Berhasil mengubah status periode!");
                }
            }
        }
        //DELETE
        elseif (isset($request->delete)) {
            //CARI PERIODE
            foreach ($listPeriode as $key => $periode) {
                if ($periode['tahun'] == $request->tahun) {
                    unset($listPeriode[$key]);
                    Session::put('listPeriode', $listPeriode);
                    return back()->with("success", "Berhasil menghapus periode!");
                }
            }
        }
        return back()->with("message", "Gagal melakukan action!");
    }
}
