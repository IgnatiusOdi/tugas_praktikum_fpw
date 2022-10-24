<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function view()
    {
        if (Session::has('mahasiswa')) {
            return view("pages.mahasiswa.home");
        } else {
            return redirect()->intended('login')->with("message", "Mahasiswa belum login!");
        }
    }

    public function join(Request $request)
    {
        $listKelas = Session::get('listKelas');
        foreach ($listKelas as $key => $kelas) {
            if ($kelas['id'] == $request->join) {
                foreach ($listKelas[$key]["mahasiswa"] as $mhs) {
                    if ($mhs == Session::get("mahasiswa")['username']) {
                        return back()->with('message', "Mahasiswa sudah bergabung!");
                    }
                }

                $now = date("Y");
                $tahun = Session::get("mahasiswa")['tahun'];
                $semester = ($now - $tahun) * 2 + 1;
                // CEK SEMESTER
                foreach (Session::get('listMataKuliah') as $matkul) {
                    if ($matkul["semester"] > $semester) {
                        return back()->with("message", "Tidak memenuhi minimal semester");
                    }
                }

                // BERHASIL
                array_push($listKelas[$key]["mahasiswa"], Session::get('mahasiswa')['username']);
                Session::put('listKelas', $listKelas);
                return back()->with("success", "Berhasil bergabung kelas!");
            }
        }
        return back()->with('message', "Gagal bergabung kelas!");
    }
}
