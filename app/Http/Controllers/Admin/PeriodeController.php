<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PeriodeController extends Controller
{
    public function view()
    {
        $listPeriode = DB::table('periode')->get();
        return view('pages.admin.periode', compact("listPeriode"));
    }

    public function tambah(Request $request)
    {
        $tahun1 = $request->tahun1;
        $tahun2 = $request->tahun2;

        $request->validate(
            [
                "tahun1" => "required",
                "tahun2" => "required | after:tahun1",
            ],
            [
                "required" => "Field harus diisi!",
                "after" => "Tahun 1 tidak boleh lebih besar atau sama dengan Tahun 2!",
            ],
        );

        //INSERT PERIODE
        $result = DB::table('periode')->insert([
            "periode_tahun" => $tahun1 . "/" . $tahun2,
            "periode_status" => 0,
        ]);

        if ($result) {
            return back()->with("success", "Berhasil menambahkan periode!");
        } else {
            return back()->with("message", "Gagal menambahkan periode!");
        }
    }

    public function action(Request $request)
    {
        $id = $request->id;

        if (isset($request->change)) {
            //UPDATE STATUS PERIODE
            if ($request->change == 0) {
                $result = DB::table('periode')->where('id', $id)->update([
                    "periode_status" => 1
                ]);
            } else {
                $result = DB::table('periode')->where('id', $id)->update([
                    "periode_status" => 0
                ]);
            }

            if ($result) {
                return back()->with("success", "Berhasil mengubah status periode!");
            } else {
                return back()->with("message", "Gagal mengubah status periode!");
            }
        } elseif (isset($request->delete)) {
            //DELETE PERIODE
            $result = DB::table('periode')->where('id', $id)->delete();

            if ($result) {
                return back()->with("success", "Berhasil menghapus periode!");
            } else {
                return back()->with("message", "Gagal menghapus periode!");
            }
        }
    }
}
