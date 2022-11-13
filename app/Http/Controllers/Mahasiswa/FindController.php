<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\KelasMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class FindController extends Controller
{
    public function view(Request $request)
    {
        $role = $request->role;
        $nama = $request->nama;
        if ($role == "dosen") {
            $result = Dosen::where('dosen_nama', 'LIKE', '%' . $nama . '%')->first();
        } else {
            $result = Mahasiswa::where('mahasiswa_nama', 'LIKE', '%' . $nama . '%')->first();
        }

        if ($result) {
            if ($role == "dosen") {
                return view('pages.mahasiswa.find', compact("result"));
            } else {
                $listKelas = KelasMahasiswa::where('mahasiswa_id', auth('guard_mahasiswa')->user()->id)->get();
                foreach ($listKelas as $key => $kelas) {
                    $cariMahasiswa = KelasMahasiswa::where('kelas_id', $kelas->kelas_id)->whereIn("mahasiswa_id", [$result->id, auth("guard_mahasiswa")->user()->id])->count();
                    if ($cariMahasiswa > 1) {
                        return view('pages.mahasiswa.find', compact("result"));
                    }
                }
                return back()->with("message", "Mahasiswa tidak pernah 1 kelas");
            }
        } else {
            return back()->with("message", "Gagal melakukan pencarian!");
        }
    }
}
