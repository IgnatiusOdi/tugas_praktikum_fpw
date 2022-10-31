<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function view()
    {
        if (Session::has('mahasiswa')) {
            $mahasiswa = Session::get('mahasiswa');
            $listKelas = DB::table('kelas')
                ->where('matakuliah.jurusan_id', $mahasiswa->jurusan_id)
                ->join('matakuliah', 'matakuliah.id', 'kelas.matakuliah_id')
                ->join('jurusan', 'jurusan.id', 'matakuliah.jurusan_id')
                ->join('hari', 'hari.id', 'kelas.hari_id')
                ->join('jam', 'jam.id', 'kelas.jam_id')
                ->join('periode', 'periode.id', 'kelas.periode_id')
                ->join('dosen', 'dosen.id', 'kelas.dosen_id')
                ->get(['kelas.id', 'matakuliah_id', 'matakuliah_nama', 'hari_nama', 'jam_nama', 'periode_tahun', 'dosen_nama', 'matakuliah_semester', 'matakuliah_sks']);
            $listPengumuman = DB::table('pengumuman')
                ->where('kelas_mahasiswa.mahasiswa_id', $mahasiswa->id)
                ->where('kelas_mahasiswa.mahasiswa_status', 1)
                ->join('kelas', 'kelas.id', 'pengumuman.kelas_id')
                ->join('matakuliah', 'matakuliah.id', 'kelas.matakuliah_id')
                ->join('kelas_mahasiswa', 'kelas_mahasiswa.kelas_id', "kelas.id")
                ->get(['matakuliah_nama', 'pengumuman_deskripsi', 'pengumuman_link']);
            $listAbsensi = DB::table('kelas_mahasiswa')
                ->where([
                    ["absensi.mahasiswa_id", '=', $mahasiswa->id],
                    ["kelas_mahasiswa.mahasiswa_id", '=', $mahasiswa->id],
                    ["kelas_mahasiswa.mahasiswa_status", '=', 1],
                ])
                ->join('kelas', 'kelas.id', 'kelas_mahasiswa.kelas_id')
                ->join('materi', 'materi.kelas_id', 'kelas.id')
                ->join('absensi', 'absensi.materi_id', 'materi.id')
                ->distinct()
                ->get(['materi_minggu', 'materi_judul', 'materi_deskripsi', 'absensi_status']);
            $listTergabung = DB::table('kelas_mahasiswa')
                ->where('mahasiswa_id', $mahasiswa->id)
                ->where('mahasiswa_status', 1)
                ->get(['kelas_id', 'mahasiswa_status']);

            return view("pages.mahasiswa.home", compact('mahasiswa', 'listKelas', 'listPengumuman', 'listAbsensi', 'listTergabung'));
        } else {
            return redirect()->intended('login')->with("message", "Mahasiswa belum login!");
        }
    }

    public function join(Request $request)
    {
        $mahasiswa = Session::get('mahasiswa');
        if (isset($request->leave)) {
            // UPDATE STATUS MAHASISWA
            $result = DB::table('kelas_mahasiswa')
                ->where('mahasiswa_id', $mahasiswa->id)
                ->where('kelas_id', $request->leave)
                ->update([
                    "mahasiswa_status" => 0,
                ]);

            if ($result) {
                return back()->with("success", "Berhasil leave kelas!");
            } else {
                return back()->with("message", "Gagal leave kelas!");
            }
        } else if (isset($request->join)) {
            // CARI DI KELAS_MAHASISWA
            $exist = DB::table('kelas_mahasiswa')
                ->where('mahasiswa_id', $mahasiswa->id)
                ->where('kelas_id', $request->join)
                ->first();

            if ($exist) {
                // TOLAK
                return back()->with("message", "Gagal bergabung karena mahasiswa pernah leave kelas!");
            } else {
                // INSERT MAHASISWA
                $result = DB::table('kelas_mahasiswa')->insert([
                    "kelas_id" => $request->join,
                    "mahasiswa_id" => $mahasiswa->id,
                    "mahasiswa_status" => 1,
                ]);

                if ($result) {
                    return back()->with('success', "Berhasil join kelas!");
                } else {
                    return back()->with('message', "Gagal join kelas!");
                }
            }
        }

        return back()->with('message', "Gagal bergabung kelas!");
    }
}
