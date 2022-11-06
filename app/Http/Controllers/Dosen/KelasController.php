<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\MahasiswaModule;
use App\Models\Materi;
use App\Models\Module;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function view(Request $request)
    {
        $listKelas = Kelas::where('dosen_id', Session::get('dosen')->id)->get();
        return view("pages.dosen.kelas", compact("listKelas"));
    }

    public function module(Request $request)
    {
        $kelas = Kelas::where('id', $request->id)->first();
        return view("pages.dosen.module", compact('kelas'));
    }

    public function createModule(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $keterangan = $request->keterangan;
        $jenis = $request->jenis;
        $deadline = date("Y-m-d H:i:s", strtotime($request->deadline));

        $request->validate([
            "nama" => "required",
            "keterangan" => "required",
            "jenis" => "required",
            "deadline" => "required",
        ]);

        $result = Module::create([
            "kelas_id" => $id,
            "module_nama" => $nama,
            "module_keterangan" => $keterangan,
            "module_jenis" => $jenis,
            "module_deadline" => $deadline,
            "module_status" => 1,
        ]);

        if ($result) {
            return redirect()->route('dosen-kelas-detail', compact("id"))->with("success", "Berhasil membuat absensi!");
        }

        return back()->with("message", "Gagal membuat module!");
    }

    public function detailModule(Request $request)
    {
        $module = Module::find($request->module);
        $listMahasiswa = KelasMahasiswa::where('kelas_id', $request->id)->get();
        $pengumpulan = MahasiswaModule::where('module_id', $request->module)->get();

        return view('pages.dosen.detailmodule', compact('module', "listMahasiswa", "pengumpulan"));
    }

    public function actionModule(Request $request)
    {
        if ($request->selesai) {
            $result = Module::find($request->selesai)->update([
                "module_status" => 0
            ]);

            if ($result) {
                return back()->with("success", "Berhasil menutup module!");
            }
            return back()->with("message", "Gagal menutup module!");
        } else {
            $id = $request->id;
            $module = $request->module;
            return redirect()->route('dosen-kelas-detail-module', [$id, $module]);
        }
        return back()->with("message", "Gagal melakukan action module!");
    }

    public function detail(Request $request)
    {
        Session::forget('editAbsensi');
        $id = $request->id;
        $kelas = Kelas::where('id', $id)->first();
        $listModule = Module::where('kelas_id', $id)->get();
        $listPengumuman = Pengumuman::where('kelas_id', $id)->get();
        $listMateri = Materi::where('kelas_id', $id)->orderBy('materi_minggu')->get();

        if ($kelas) {
            return view("pages.dosen.detail", compact("id", "kelas", "listModule", "listPengumuman", "listMateri"));
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
            $materi = Materi::where('id', $absensi)->first();
            $listMahasiswa = Absensi::where('materi_id', $absensi)->get();

            return view('pages.dosen.absensi', compact('id', 'absensi', 'materi', 'listMahasiswa'));
        } else {
            // CREATE
            $kelas = Kelas::where('id', $request->id)->first();
            $listMahasiswa = KelasMahasiswa::where('kelas_id', $request->id)->get();

            return view("pages.dosen.absensi", compact("kelas", "listMahasiswa"));
        }
        return back()->with("message", "Gagal membuka absensi!");
    }

    public function actionAbsensi(Request $request)
    {
        if (isset($request->edit)) {
            $absensi = $request->edit;
            $id = Materi::where('id', $absensi)->pluck('kelas_id')->first();
            Session::put('editAbsensi', $absensi);
            return redirect()->route('dosen-kelas-absensi', compact("id", "absensi"));
        } else if (isset($request->delete)) {
            //DELETE MATERI
            $result = Materi::where('id', $request->delete)->delete();
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
            $result = Materi::where('id', $request->id)->update([
                "materi_minggu" => $request->minggu,
                "materi_judul" => $request->materi,
                "materi_deskripsi" => $request->deskripsi,
            ]);

            if ($result) {
                return back()->withInput()->with('message', "Gagal mengedit absensi!");
            }

            //UPDATE ABSENSI
            $listMahasiswa = Absensi::where('materi_id', $request->absensi)->get();
            $hadir = $request->hadir;
            $counter = 0;
            foreach ($listMahasiswa as $mahasiswa) {
                $status = false;
                if ($hadir && count($hadir) > 0) {
                    if ($hadir[$counter] == $mahasiswa->id) {
                        $status = true;
                    }
                }

                $result = Absensi::where('materi_id', $request->absensi)
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
            $result = Materi::create([
                "materi_minggu" => $request->minggu,
                "materi_judul" => $request->materi,
                "materi_deskripsi" => $request->deskripsi,
                "kelas_id" => $request->id,
            ]);

            if (!$result) {
                return back()->withInput()->with('message', "Gagal membuat absensi!");
            }

            //INSERT ABSENSI
            $indexMateri = Materi::latest('id')->pluck('id')->first();
            $listMahasiswa = KelasMahasiswa::where('kelas_id', $request->id)->get();

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

            $result = Absensi::insert($kehadiran);

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
        $result = Pengumuman::create([
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
