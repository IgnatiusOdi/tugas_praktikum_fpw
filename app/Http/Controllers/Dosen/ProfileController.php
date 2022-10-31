<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Rules\RuleNomorTelepon;
use App\Rules\RulePassword;
use App\Rules\RuleUsername;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function view()
    {
        $dosen = DB::table('dosen')
            ->join('jurusan', 'jurusan.id', 'dosen.jurusan_id')
            ->where('dosen.id', Session::get('dosen')->id)
            ->first([
                "dosen.id", "dosen_nama", "dosen_username", "dosen_email", "dosen_telepon", "dosen_tanggal_lahir", "jurusan_nama",
                "dosen_kelulusan", "dosen_password"
            ]);
        return view("pages.dosen.profile", compact('dosen'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $username = $request->username;
        $email = $request->email;
        $telepon = $request->telepon;
        $password = $request->password;

        $listTeleponMahasiswa = DB::table('mahasiswa')->get('mahasiswa_telepon');
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
        $countUsername = DB::table('dosen')->where('dosen_username', $username)->count();
        if ($countUsername > 1) {
            return back()->withInput()->withErrors(['username' => "Username harus unik!"]);
        }
        $countEmail = DB::table('dosen')->where('dosen_email', $email)->count();
        if ($countEmail > 1) {
            return back()->withInput()->withErrors(['email' => "Email harus unik!"]);
        }
        $countTelepon = DB::table('dosen')->where('dosen_telepon', $telepon)->count();
        if ($countTelepon > 1) {
            return back()->withInput()->withErrors(['telepon' => "Nomor telepon harus unik!"]);
        }

        //UPDATE DOSEN
        $result = DB::table('dosen')->where('id', $id)->update([
            "dosen_username" => $username,
            "dosen_email" => $email,
            "dosen_telepon" => $telepon,
            "dosen_password" => $password,
        ]);

        if ($result) {
            //REPLACE SESSION
            $dosen = DB::table('dosen')->where('id', $id)->first();
            Session::put('dosen', $dosen);
            return back()->with("success", "Berhasil edit profile dosen!");
        } else {
            return back()->with("message", "Gagal edit profile dosen!");
        }
    }
}
