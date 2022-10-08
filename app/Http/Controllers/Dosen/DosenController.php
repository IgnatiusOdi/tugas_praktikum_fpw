<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Rules\RuleNomorTelepon;
use App\Rules\RulePassword;
use App\Rules\RuleUsername;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{
    public function logout()
    {
        Session::forget('dosen');
        return redirect()->intended("login")->with("success", "Berhasil logout!");
    }

    public function viewRegister()
    {
        // Session::flush();
        return view('pages.dosen.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                "username" => ["required", "alpha_dash", "min:5", "max:10", new RuleUsername(Session::get('listUser'))],
                "nama" => "required",
                "email" => "required | email",
                "nomor" => ["required", "numeric", "digits_between:10,12", new RuleNomorTelepon(Session::get('listUser'))],
                "tanggal" => "required | date | before:-22 years",
                "jurusan" => "required",
                "tahun" => "required | date | after_or_equal:01/01/1990 | before:today",
                "password" => ["required", "alpha_dash", "min:6", "max:12",  new RulePassword($request->username), "confirmed"],
                "password_confirmation" => "required",
                "snk" => "accepted"
            ],
            [
                "required" => "Field wajib diisi!",
                "tahun.after" => "Minimal tanggal adalah 1 Januari 1990!",
                "tahun.before" => "Maksimal tanggal adalah kemarin!",
                "digits_between" => "Nomor telepon minimal 10 digit dan maksimal 12 digit!",
                "email" => "Email yang digunakan harus email valid!",
                "tanggal.before" => "Umur harus lebih dari 21 tahun!",
                "accepted" => "Konfirmasi syarat dan ketentuan harus tercentang!",
            ]
        );

        //PUSH SESSION
        Session::push('listUser', [
            "username" => $request->username,
            "nama" => $request->nama,
            "email" => $request->email,
            "nomor" => $request->nomor,
            "tanggal" => $request->tanggal,
            "jurusan" => $request->jurusan,
            "tahun" => $request->tahun,
            "password" => $request->password,
            "role" => "dosen"
        ]);

        return back()->with("success", "Berhasil register!");
    }
}
