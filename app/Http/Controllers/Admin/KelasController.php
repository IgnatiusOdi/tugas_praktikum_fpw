<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function view()
    {
        $listMatakuliah = DB::table('matakuliah')->get();
        $listHari = DB::table('hari')->get();
        $listJam = DB::table('jam')->get();
        $listPeriode = DB::table('periode')->get();
        $listDosen = DB::table('dosen')->get();
        $listKelas = DB::table('kelas')
            ->join('matakuliah', 'matakuliah.id', 'kelas.matakuliah_id')
            ->join('hari', 'hari.id', 'kelas.hari_id')
            ->join('jam', 'jam.id', 'kelas.jam_id')
            ->join('periode', 'periode.id', 'kelas.periode_id')
            ->join('dosen', 'dosen.id', 'kelas.dosen_id')
            ->get(["kelas.id", "matakuliah_nama", "hari_nama", "jam_nama", "periode_tahun", "dosen_nama"]);
        return view("pages.admin.kelas", compact("listMatakuliah", "listHari", "listJam", "listPeriode", "listDosen", "listKelas"));
    }

    public function tambah(Request $request)
    {
        $matakuliah = $request->matakuliah;
        $hari = $request->hari;
        $jam = $request->jam;
        $periode = $request->periode;
        $dosen = $request->dosen;
        $id = $request->id;

        if ($request->button == "Tambah") {
            $request->validate(
                [
                    "matakuliah" => "required",
                    "hari" => "required",
                    "jam" => "required",
                    "periode" => "required",
                    "dosen" => "required",
                ],
                [
                    "required" => "Field harus diisi!",
                ]
            );

            //INSERT KELAS
            $result = DB::table('kelas')->insert([
                "matakuliah_id" => $matakuliah,
                "hari_id" => $hari,
                "jam_id" => $jam,
                "periode_id" => $periode,
                "dosen_id" => $dosen,
            ]);

            if ($result) {
                return back()->with("success", "Berhasil menambahkan kelas!");
            } else {
                return back()->with("message", "Gagal menambahkan kelas!");
            }
        } else {
            $request->validate(
                [
                    "matakuliah" => "required",
                    "hari" => "required",
                    "jam" => "required",
                    "periode" => "required",
                ],
                [
                    "required" => "Field harus diisi!",
                ]
            );

            //UPDATE KELAS
            $result = DB::table('kelas')->where('id', $id)->update([
                "matakuliah_id" => $matakuliah,
                "hari_id" => $hari,
                "jam_id" => $jam,
                "periode_id" => $periode,
            ]);
            Session::forget("editKelas");

            if ($result) {
                return back()->with("success", "Berhasil mengedit kelas!");
            } else {
                return back()->with("message", "Gagal mengedit kelas!");
            }
        }
    }

    public function action(Request $request)
    {
        if (isset($request->edit)) {
            Session::put("editKelas", DB::table('kelas')->where('id', $request->edit)->first());
            return back();
        } else if (isset($request->delete)) {
            Session::forget("editKelas");

            //DELETE KELAS
            $result = DB::table('kelas')->where('id', $request->delete)->delete();
            if ($result) {
                return back()->with("success", "Berhasil menghapus kelas!");
            } else {
                return back()->with("message", "Gagal menghapus kelas!");
            }
        }
        return back()->with("message", "Gagal melakukan action!");
    }
}
