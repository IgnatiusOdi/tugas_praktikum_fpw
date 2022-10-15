<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Rules\RuleNamaLengkap;
use App\Rules\RuleNamaLengkapVowel;
use App\Rules\RuleNomorTelepon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    public function logout()
    {
        Session::forget('mahasiswa');
        return redirect()->intended("login")->with("success", "Berhasil logout!");
    }

    public function viewRegister()
    {
        // Session::flush();
        return view('pages.mahasiswa.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                "nama" => ["required", new RuleNamaLengkap(), new RuleNamaLengkapVowel()],
                "email" => "required | email",
                "nomor" => ["required", "numeric", "digits_between:10,12", new RuleNomorTelepon(Session::get('listUser'))],
                "tanggal" => "required | date | before:-18 years",
                "jurusan" => "required",
                "tahun" => "required",
                "snk" => "accepted"
            ],
            [
                "required" => "Field wajib diisi!",
                "digits_between" => "Nomor telepon minimal 10 digit dan maksimal 12 digit!",
                "email" => "Email yang digunakan harus email valid!",
                "before" => "Umur harus lebih dari 17 tahun!",
                "accepted" => "Konfirmasi syarat dan ketentuan harus tercentang!",
            ]
        );

        //NRP
        $splitTahun = str_split($request->tahun);
        $nrp = $splitTahun[0] . $splitTahun[2] . $splitTahun[3];
        $id = 1;
        foreach (Session::get('listUser') as $user) {
            if ($user['role'] == 'mahasiswa') {
                if (substr($user["nrp"], 0, 3) == $nrp) {
                    $id += 1;
                }
            }
        }
        for ($i = 0; $i < 3 - strlen($id); $i++) {
            $nrp .= "0";
        }
        $nrp .= $id;

        //PASSWORD
        $words = explode(' ', $request->nama);
        $yearFormat = date("Y", strtotime($request->tanggal));
        $year = str_split($yearFormat);
        $password = $words[count($words) - 1] . $year[count($year) - 2] . $year[count($year) - 1];

        //PUSH SESSION
        Session::push('listUser', [
            "username" => $nrp,
            "nama" => $request->nama,
            "email" => $request->email,
            "nomor" => $request->nomor,
            "tanggal" => $request->tanggal,
            "jurusan" => $request->jurusan,
            "tahun" => $request->tahun,
            "password" => $password,
            "role" => "mahasiswa"
        ]);

        return back()->with("success", "Berhasil register!");
    }
}
