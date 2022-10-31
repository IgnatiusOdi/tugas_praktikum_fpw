<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function view(Request $request)
    {
        $listKelas = DB::table('kelas')->where('dosen_id', Session::get('dosen')->id)
            ->join('matakuliah', 'matakuliah.id', 'kelas.matakuliah_id')
            ->join('hari', 'hari.id', 'kelas.hari_id')
            ->join('jam', 'jam.id', 'kelas.jam_id')
            ->join('periode', 'periode.id', 'kelas.periode_id')
            ->get(["kelas.id", "matakuliah_nama", "hari_nama", "jam_nama", "periode_tahun"]);
        return view("pages.dosen.kelas", compact("listKelas"));
    }

    public function detail(Request $request)
    {
        Session::forget('editAbsensi');
        $kelas = DB::table('kelas')
            ->where('id', $request->id)
            ->first();
        $listPengumuman = DB::table('pengumuman')
            ->where('kelas_id', $request->id)
            ->get();
        $listMateri = DB::table('materi')
            ->where('kelas_id', $request->id)
            ->orderBy('materi_minggu')
            ->get();

        if ($kelas) {
            return view("pages.dosen.detail", compact("kelas", "listPengumuman", "listMateri"));
        } else {
            return back()->with("message", "Gagal membuka detail kelas!");
        }
    }

    public function absensi(Request $request)
    {
        if (Session::has('editAbsensi')) {
            // EDIT
            $id = $request->id;
            $absensi = $request->absensi;
            $materi = DB::table('materi')->where('id', $absensi)->first();
            $listMahasiswa = DB::table('absensi')
                ->where('materi_id', $absensi)
                ->join('mahasiswa', 'mahasiswa.id', 'absensi.mahasiswa_id')
                ->get(['mahasiswa.id', "mahasiswa.mahasiswa_nrp", 'mahasiswa.mahasiswa_nama', 'absensi_status']);

            return view('pages.dosen.absensi', compact('id', 'absensi', 'materi', 'listMahasiswa'));
        } else {
            // CREATE
            $kelas = DB::table('kelas')
                ->where('id', $request->id)
                ->first();
            $listMahasiswa = DB::table('kelas_mahasiswa')
                ->where('kelas_id', $request->id)
                ->join('mahasiswa', 'mahasiswa.id', 'kelas_mahasiswa.mahasiswa_id')
                ->get(['mahasiswa.id', "mahasiswa.mahasiswa_nrp", 'mahasiswa.mahasiswa_nama']);

            return view("pages.dosen.absensi", compact("kelas", "listMahasiswa"));
        }
        return back()->with("message", "Gagal membuka absensi!");
    }

    public function actionAbsensi(Request $request)
    {
        if (isset($request->edit)) {
            $absensi = $request->edit;
            $id = DB::table('materi')->where('id', $absensi)->pluck('kelas_id')->first();
            Session::put('editAbsensi', $absensi);
            return redirect()->route('dosen-kelas-absensi', compact("id", "absensi"));
        } else if (isset($request->delete)) {
            //DELETE MATERI
            $result = DB::table('materi')->where('id', $request->delete)->delete();
            if ($result) {
                return back()->with("success", "Berhasil menghapus absensi!");
            } else {
                return back()->with("message", "Gagal menghapus absensi!");
            }
        }
    }

    public function createAbsensi(Request $request)
    {
        $request->validate([
            "minggu" => "required | integer | min:1 | max:14",
            "materi" => "required",
            "deskripsi" => "required",
        ]);

        if (Session::has('editAbsensi')) {
            //UPDATE MATERI
            $result = DB::table('materi')->where('id', $request->id)->update([
                "materi_minggu" => $request->minggu,
                "materi_judul" => $request->materi,
                "materi_deskripsi" => $request->deskripsi,
            ]);

            if ($result) {
                return back()->withInput()->with('message', "Gagal mengedit absensi!");
            }

            //UPDATE ABSENSI
            $listMahasiswa = DB::table('absensi')->where('materi_id', $request->absensi)->get();
            $hadir = $request->hadir;
            $counter = 0;
            foreach ($listMahasiswa as $mahasiswa) {
                $status = false;
                if ($hadir && count($hadir) > 0) {
                    if ($hadir[$counter] == $mahasiswa->id) {
                        $status = true;
                    }
                }

                $result = DB::table('absensi')
                    ->where('materi_id', $request->absensi)
                    ->where('mahasiswa_id', $mahasiswa->id)
                    ->update([
                        "absensi_status" => $status
                    ]);

                if ($status) {
                    unset($hadir[$counter]);
                    $counter++;
                }
            }

            $id = $request->id;
            return redirect()->route('dosen-kelas-detail', compact("id"))->with("success", "Berhasil mengedit absensi!");
        } else {
            //INSERT MATERI
            $result = DB::table('materi')->insert([
                "materi_minggu" => $request->minggu,
                "materi_judul" => $request->materi,
                "materi_deskripsi" => $request->deskripsi,
                "kelas_id" => $request->id,
            ]);

            if (!$result) {
                return back()->withInput()->with('message', "Gagal membuat absensi!");
            }

            //INSERT ABSENSI
            $indexMateri = DB::table('materi')->latest('id')->get('id')->first();
            $listMahasiswa = DB::table('kelas_mahasiswa')->where('kelas_id', $request->id)->get();

            $kehadiran = [];
            $hadir = $request->hadir;
            $counter = 0;
            foreach ($listMahasiswa as $mahasiswa) {
                $status = false;
                if ($hadir && count($hadir) > 0) {
                    if ($hadir[$counter] == $mahasiswa->id) {
                        unset($hadir[$counter]);
                        $counter++;
                        $status = true;
                    }
                }
                array_push($kehadiran, [
                    "materi_id" => $indexMateri->id,
                    "mahasiswa_id" => $mahasiswa->id,
                    "absensi_status" => $status,
                ]);
            }

            $result = DB::table('absensi')->insert($kehadiran);

            if (!$result) {
                return back()->withInput()->with('message', "Gagal membuat absensi!");
            }

            $id = $request->id;
            return redirect()->route('dosen-kelas-detail', compact("id"))->with("success", "Berhasil membuat absensi!");
        }
    }

    public function pengumuman(Request $request)
    {
        $id = $request->id;
        return view('pages.dosen.pengumuman', compact("id"));
    }

    public function createPengumuman(Request $request)
    {
        $id = $request->id;
        $deskripsi = $request->deskripsi;
        $link = $request->link;

        $request->validate([
            "deskripsi" => "required",
        ]);

        //INSERT PENGUMUMAN
        $result = DB::table('pengumuman')->insert([
            "kelas_id" => $id,
            "pengumuman_deskripsi" => $deskripsi,
            "pengumuman_link" => $link,
        ]);

        if ($result) {
            return redirect()->route('dosen-kelas-detail', compact("id"))->with("success", "Berhasil membuat pengumuman!");
        } else {
            return back()->withInput()->with("message", "Gagal membuat pengumuman!");
        }
    }
}
