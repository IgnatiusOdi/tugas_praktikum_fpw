<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\RuleMataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MataKuliahController extends Controller
{
    public function view()
    {
        $listJurusan = DB::table('jurusan')->get();
        $listMatakuliah = DB::table('matakuliah')
            ->join('jurusan', 'jurusan.id', 'matakuliah.jurusan_id')
            ->get(["matakuliah.id", "matakuliah_kode", "matakuliah_nama", "jurusan_kode", "matakuliah_semester", "matakuliah_sks"]);
        return view("pages.admin.matakuliah", compact("listJurusan", "listMatakuliah"));
    }

    public function tambah(Request $request)
    {
        $nama = $request->nama;
        $jurusan = $request->jurusan;
        $semester = $request->semester;
        $sks = $request->sks;
        $id = $request->id;
        $jurusan_kode = DB::table('jurusan')->where('id', $jurusan)->pluck('jurusan_kode')->first();

        if ($request->button == "Tambah") {
            $request->validate(
                [
                    "nama" => "required | unique:matakuliah,matakuliah_nama",
                    "jurusan" => "required",
                    "semester" => "required | integer | between:1,8",
                    "sks" => "required | integer | gte:2",
                ],
                [
                    "required" => "Field harus diisi!",
                    "nama.unique" => "Nama Mata Kuliah harus unik!",
                    "between" => "Minimal semester harus antara semester 1 hingga 8",
                    "gte" => "Minimal SKS adalah 2",
                ]
            );

            //CREATE KODE
            $words = explode(' ', strtoupper($nama));
            $kode = $jurusan_kode;
            if (count($words) > 1) {
                foreach ($words as $initial) {
                    $kode .= $initial[0];
                }
            } else {
                $kode .= $words[0][0] . $words[0][1];
            }

            //INSERT MATAKULIAH
            $result = DB::table('matakuliah')->insert([
                "matakuliah_kode" => $kode,
                "matakuliah_nama" => $nama,
                "jurusan_id" => $jurusan,
                "matakuliah_semester" => $semester,
                "matakuliah_sks" => $sks
            ]);

            if ($result) {
                return back()->with("success", "Berhasil menambahkan mata kuliah!");
            } else {
                return back()->with("message", "Gagal menambahkan mata kuliah!");
            }
        } else {
            $request->validate(
                [
                    "nama" => "required",
                    "semester" => "required | integer | between:1,8",
                    "sks" => "required | integer | gte:2",
                ],
                [
                    "required" => "Field harus diisi!",
                    "between" => "Minimal semester harus antara semester 1 hingga 8",
                    "gte" => "Minimal SKS adalah 2",
                ]
            );

            //UPDATE MATAKULIAH
            $result = DB::table('matakuliah')->where("id", $id)->update([
                "matakuliah_nama" => $nama,
                "matakuliah_semester" => $semester,
                "matakuliah_sks" => $sks
            ]);
            Session::forget('editMatakuliah');

            if ($result) {
                return back()->with("success", "Berhasil mengedit mata kuliah!");
            } else {
                return back()->with("message", "Gagal mengedit mata kuliah!");
            }
        }
    }

    public function action(Request $request)
    {
        if (isset($request->edit)) {
            Session::put("editMatakuliah", DB::table('matakuliah')->where('id', $request->edit)->first());
            return back();
        } else if (isset($request->delete)) {
            Session::forget("editMatakuliah");

            //DELETE MATAKULIAH
            $result = DB::table('matakuliah')->where('id', $request->delete)->delete();
            if ($result) {
                return back()->with("success", "Berhasil menghapus mata kuliah!");
            } else {
                return back()->with("message", "Gagal menghapus mata kuliah!");
            }
        }
        return back()->with("message", "Gagal melakukan action!");
    }
}
