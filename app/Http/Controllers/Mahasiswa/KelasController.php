<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KelasController extends Controller
{
    public function view(Request $request)
    {
        $listKelas = KelasMahasiswa::where('mahasiswa_id', Session::get('mahasiswa')->id)->where('mahasiswa_status', 1)->get();
        return view("pages.mahasiswa.kelas", compact("listKelas"));
    }

    public function detail(Request $request)
    {
        $kelas = Kelas::find($request->id);
        $listAbsensi = $kelas->materi->map(fn ($a) => $a->absensi)->collapse()->where('mahasiswa_id', Session::get('mahasiswa')->id);

        return view("pages.mahasiswa.detail", compact("kelas", "listAbsensi"));
    }
}
