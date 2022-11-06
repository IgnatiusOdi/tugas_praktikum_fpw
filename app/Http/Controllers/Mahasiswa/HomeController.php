<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\KelasMahasiswa;
use App\Models\MahasiswaModule;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function view()
    {
        if (Session::has('mahasiswa')) {
            $mahasiswa = Session::get('mahasiswa');
            $listKelas = Kelas::all();
            $listTergabung = KelasMahasiswa::where('mahasiswa_id', $mahasiswa->id)->where('mahasiswa_status', 1)->get();
            return view("pages.mahasiswa.home", compact('mahasiswa', 'listKelas', 'listTergabung'));
        } else {
            return redirect()->intended('login')->with("message", "Mahasiswa belum login!");
        }
    }

    public function viewModule(Request $request)
    {
        $module = Module::find($request->id);
        return view('pages.mahasiswa.module', compact('module'));
    }

    public function submit(Request $request)
    {
        $id = $request->id;
        $jawaban = $request->jawaban;

        $request->validate([
            "jawaban" => "required"
        ]);

        $module = Module::find($id);

        //CEK SUDAH DEADLINE
        if ($module->module_status == 1 && now() < $module->module_deadline) {
            //CEK SUDAH PERNAH KUMPUL / BELUM
            $exist = MahasiswaModule::where('module_id', $id)->where('mahasiswa_id', Session::get('mahasiswa')->id)->first();

            if ($exist) {
                //UPDATE
                $result = MahasiswaModule::where('id', $exist->id)->update([
                    "module_jawaban" => $jawaban,
                ]);
            } else {
                //INSERT
                $result = MahasiswaModule::create([
                    "module_id" => $id,
                    "mahasiswa_id" => Session::get('mahasiswa')->id,
                    "module_jawaban" => $jawaban,
                ]);
            }

            if ($result) {
                return back()->with("success", "Berhasil submit module!");
            }
            return back()->with("message", "Gagal submit module!");
        } else {
            Module::where('id', $id)->update([
                "module_status" => 0
            ]);
            return back()->with("message", "Gagal submit module karena melewati deadline!");
        }
    }

    public function join(Request $request)
    {
        $mahasiswa = Session::get('mahasiswa');
        if (isset($request->leave)) {
            // UPDATE STATUS MAHASISWA
            $result = KelasMahasiswa::where('mahasiswa_id', $mahasiswa->id)->where('kelas_id', $request->leave)
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
            $exist = KelasMahasiswa::where('mahasiswa_id', $mahasiswa->id)->where('kelas_id', $request->join)->first();

            if ($exist) {
                // TOLAK
                return back()->with("message", "Gagal bergabung karena mahasiswa pernah leave kelas!");
            } else {
                // INSERT MAHASISWA
                $result = KelasMahasiswa::create([
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
