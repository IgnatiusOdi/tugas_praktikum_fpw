<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Rules\RuleNomorTelepon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function view()
    {
        $mahasiswa = Mahasiswa::find(Session::get('mahasiswa')->id);
        return view("pages.mahasiswa.profile", compact('mahasiswa'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $email = $request->email;
        $telepon = $request->telepon;
        $password = $request->password;

        $listTeleponDosen = Dosen::get('dosen_telepon');
        $request->validate(
            [
                "email" => "required | email",
                "telepon" => ["required", "numeric", "digits_between:10,12", new RuleNomorTelepon($listTeleponDosen, "dosen")],
                "password" => ["required", "alpha_dash", "min:6", "max:12", "confirmed"],
                "password_confirmation" => "required",
            ]
        );

        // CEK EMAIL TELEPON UNIQUE
        $countEmail = Mahasiswa::where('id', "<>", $id)->where('mahasiswa_email', $email)->count();
        if ($countEmail > 0) {
            return back()->withInput()->withErrors(['email' => "Email harus unik!"]);
        }
        $countTelepon = Mahasiswa::where('id', "<>", $id)->where('mahasiswa_telepon', $telepon)->count();
        if ($countTelepon > 0) {
            return back()->withInput()->withErrors(['telepon' => "Nomor telepon harus unik!"]);
        }

        //UPDATE MAHASISWA
        $result = Mahasiswa::where('id', $id)->update([
            "mahasiswa_email" => $email,
            "mahasiswa_telepon" => $telepon,
            "mahasiswa_password" => $password,
        ]);

        if ($result) {
            //REPLACE SESSION
            $mahasiswa = Mahasiswa::find($id);
            Session::put('mahasiswa', $mahasiswa);
            return back()->with("success", "Berhasil edit profile mahasiswa!");
        } else {
            return back()->with("message", "Gagal edit profile mahasiswa!");
        }
    }
}
