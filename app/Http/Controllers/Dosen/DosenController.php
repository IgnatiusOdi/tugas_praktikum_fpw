<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Rules\RuleNomorTelepon;
use App\Rules\RulePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DosenController extends Controller
{
    public function logout()
    {
        auth("guard_dosen")->logout();
        return redirect('/')->with("success", "Berhasil logout!");
    }

    public function viewRegister()
    {
        // Session::flush();
        $listJurusan = Jurusan::all();
        return view('pages.dosen.register', compact("listJurusan"));
    }

    public function register(Request $request)
    {
        $username = $request->username;
        $nama = $request->nama;
        $email = $request->email;
        $telepon = $request->telepon;
        $tanggal_lahir = $request->tanggal_lahir;
        $jurusan = $request->jurusan;
        $kelulusan = $request->kelulusan;
        $password = $request->password;

        $listTeleponMahasiswa = Mahasiswa::get('mahasiswa_telepon');
        $request->validate(
            [
                "username" => ["required", "alpha_dash", "min:5", "max:10", "unique:dosen,dosen_username"],
                "nama" => "required",
                "email" => "required | email | unique:dosen,dosen_email",
                "telepon" => ["required", "numeric", "digits_between:10,12", "unique:dosen,dosen_telepon", new RuleNomorTelepon($listTeleponMahasiswa, "mahasiswa")],
                "tanggal_lahir" => "required | date | before:-22 years",
                "jurusan" => "required",
                "kelulusan" => "required | date | after_or_equal:01/01/1990 | before:today",
                "password" => ["required", "alpha_dash", "min:6", "max:12",  new RulePassword($request->username), "confirmed"],
                "password_confirmation" => "required",
                "snk" => "accepted"
            ],
            [
                "required" => "Field wajib diisi!",
                "username.unique" => "Username harus unik!",
                "email" => "Email yang digunakan harus email valid!",
                "email.unique" => "Email harus unik!",
                "digits_between" => "Nomor telepon minimal 10 digit dan maksimal 12 digit!",
                "tanggal.before" => "Umur harus lebih dari 21 tahun!",
                "tahun.after" => "Minimal tanggal adalah 1 Januari 1990!",
                "tahun.before" => "Maksimal tanggal adalah kemarin!",
                "accepted" => "Konfirmasi syarat dan ketentuan harus tercentang!",
            ]
        );

        //INSERT DOSEN
        $result = Dosen::create([
            "dosen_username" => $username,
            "dosen_nama" => $nama,
            "dosen_email" => $email,
            "dosen_telepon" => $telepon,
            "dosen_tanggal_lahir" => $tanggal_lahir,
            "jurusan_id" => $jurusan,
            "dosen_kelulusan" => $kelulusan,
            "dosen_password" => $password,
        ]);

        if ($result) {
            return back()->with("success", "Berhasil register dosen!");
        } else {
            return back()->withInput()->with("message", "Gagal register dosen!");
        }
    }
}
