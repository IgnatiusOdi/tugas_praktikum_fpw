<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Rules\RuleNomorTelepon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function view()
    {
        $mahasiswa = DB::table('mahasiswa')
            ->join('jurusan', 'jurusan.id', 'mahasiswa.jurusan_id')
            ->where('mahasiswa.id', Session::get('mahasiswa')->id)
            ->first([
                "mahasiswa.id", "mahasiswa_nama", "mahasiswa_nrp", "mahasiswa_email", "mahasiswa_telepon", "mahasiswa_tanggal_lahir", "jurusan_nama",
                "mahasiswa_angkatan", "mahasiswa_password"
            ]);
        return view("pages.mahasiswa.profile", compact('mahasiswa'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $email = $request->email;
        $telepon = $request->telepon;
        $password = $request->password;

        $listTeleponDosen = DB::table('dosen')->get('dosen_telepon');
        $request->validate(
            [
                "email" => "required | email",
                "telepon" => ["required", "numeric", "digits_between:10,12", new RuleNomorTelepon($listTeleponDosen, "dosen")],
                "password" => ["required", "alpha_dash", "min:6", "max:12", "confirmed"],
                "password_confirmation" => "required",
            ]
        );

        // CEK EMAIL TELEPON UNIQUE
        $countEmail = DB::table('mahasiswa')
            ->where('id', "<>", $id)
            ->where('mahasiswa_email', $email)
            ->count();
        if ($countEmail > 0) {
            return back()->withInput()->withErrors(['email' => "Email harus unik!"]);
        }
        $countTelepon = DB::table('mahasiswa')
            ->where('id', "<>", $id)
            ->where('mahasiswa_telepon', $telepon)
            ->count();
        if ($countTelepon > 0) {
            return back()->withInput()->withErrors(['telepon' => "Nomor telepon harus unik!"]);
        }

        //UPDATE MAHASISWA
        $result = DB::table('mahasiswa')->where('id', $id)->update([
            "mahasiswa_email" => $email,
            "mahasiswa_telepon" => $telepon,
            "mahasiswa_password" => $password,
        ]);

        if ($result) {
            //REPLACE SESSION
            $mahasiswa = DB::table('mahasiswa')->where('id', $id)->first();
            Session::put('mahasiswa', $mahasiswa);
            return back()->with("success", "Berhasil edit profile mahasiswa!");
        } else {
            return back()->with("message", "Gagal edit profile mahasiswa!");
        }
    }
}
