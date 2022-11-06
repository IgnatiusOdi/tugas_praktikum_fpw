<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Rules\RuleNomorTelepon;
use App\Rules\RulePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function view()
    {
        $dosen = Dosen::where('id', Session::get('dosen')->id)->first();
        return view("pages.dosen.profile", compact('dosen'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $username = $request->username;
        $email = $request->email;
        $telepon = $request->telepon;
        $password = $request->password;

        $listTeleponMahasiswa = Mahasiswa::get('mahasiswa_telepon');
        $request->validate(
            [
                "username" => "required | alpha_dash | min:5 | max:10",
                "email" => "required | email",
                "telepon" => ["required", "numeric", "digits_between:10,12", new RuleNomorTelepon($listTeleponMahasiswa, "mahasiswa")],
                "password" => ["required", "alpha_dash", "min:6", "max:12",  new RulePassword($username), "confirmed"],
                "password_confirmation" => "required",
            ]
        );

        // CEK USERNAME EMAIL TELEPON UNIQUE
        $countUsername = Dosen::where('id', "<>", $id)->where('dosen_username', $username)->count();
        dd($countUsername);
        if ($countUsername > 0) {
            return back()->withInput()->withErrors(['username' => "Username harus unik!"]);
        }
        $countEmail = Dosen::where('id', "<>", $id)->where('dosen_email', $email)->count();
        if ($countEmail > 0) {
            return back()->withInput()->withErrors(['email' => "Email harus unik!"]);
        }
        $countTelepon = Dosen::where('id', "<>", $id)->where('dosen_telepon', $telepon)->count();
        if ($countTelepon > 0) {
            return back()->withInput()->withErrors(['telepon' => "Nomor telepon harus unik!"]);
        }

        //UPDATE DOSEN
        $result = Dosen::where('id', $id)->update([
            "dosen_username" => $username,
            "dosen_email" => $email,
            "dosen_telepon" => $telepon,
            "dosen_password" => $password,
        ]);

        if ($result) {
            //REPLACE SESSION
            $dosen = Dosen::where('id', $id)->first();
            Session::put('dosen', $dosen);
            return back()->with("success", "Berhasil edit profile dosen!");
        } else {
            return back()->with("message", "Gagal edit profile dosen!");
        }
    }
}
