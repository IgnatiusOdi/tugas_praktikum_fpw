<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function logout()
    {
        Session::forget('admin');
        return redirect()->intended("login")->with("success", "Berhasil logout!");
    }

    public function view()
    {
        if (Session::has('admin')) {
            $listDosen = Dosen::withTrashed()->get();
            $listMahasiswa = Mahasiswa::withTrashed()->get();
            return view("pages.admin.dashboard", compact("listDosen", "listMahasiswa"));
        } else {
            return redirect()->intended('login')->with("message", "Admin belum login!");
        }
    }

    public function banDosen(Request $request)
    {
        $dosen = Dosen::withTrashed()->find($request->id);
        if ($dosen->deleted_at == null) {
            $dosen->delete();
            return back()->with("success", "Berhasil ban dosen!");
        } else {
            $dosen->restore();
            return back()->with("success", "Berhasil unban dosen!");
        }
        return back()->with("message", "Gagal melakukan action!");
    }

    public function banMahasiswa()
    {
        $mahasiswa = Mahasiswa::withTrashed()->find(request()->id);
        if ($mahasiswa->deleted_at == null) {
            $mahasiswa->delete();
            return back()->with("success", "Berhasil ban mahasiswa!");
        } else {
            $mahasiswa->restore();
            return back()->with("success", "Berhasil unban mahasiswa!");
        }
        return back()->with("message", "Gagal melakukan action!");
    }
}
