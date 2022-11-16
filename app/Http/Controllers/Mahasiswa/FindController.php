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
        $nama = $request->nama;
        $listDosen = Dosen::withTrashed()->where('dosen_nama', 'LIKE', '%' . $nama . '%')->get();
        $listMahasiswa = Mahasiswa::withTrashed()->where('mahasiswa_nama', 'LIKE', '%' . $nama . '%')->get();

        return view('pages.mahasiswa.find', compact("listDosen", "listMahasiswa"));
    }

    public function viewDosen(Request $request)
    {
        $result = Dosen::withTrashed()->find($request->id);
        return view('pages.mahasiswa.detailfind', compact("result"));
    }

    public function viewMahasiswa(Request $request)
    {
        $result = Mahasiswa::withTrashed()->find($request->id);
        $listKelas = KelasMahasiswa::where('mahasiswa_id', auth('guard_mahasiswa')->user()->id)->get();
        foreach ($listKelas as $key => $kelas) {
            $cariMahasiswa = KelasMahasiswa::where('kelas_id', $kelas->kelas_id)->whereIn("mahasiswa_id", [$result->id, auth("guard_mahasiswa")->user()->id])->count();
            if ($cariMahasiswa > 1) {
                return view('pages.mahasiswa.detailfind', compact("result"));
            }
        }
        return back()->with("message", "Mahasiswa tidak pernah 1 kelas");
    }
}
