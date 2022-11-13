<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Rules\RuleNamaLengkap;
use App\Rules\RuleNamaLengkapVowel;
use App\Rules\RuleNomorTelepon;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function logout()
    {
        auth("guard_mahasiswa")->logout();
        return redirect('/')->with("success", "Berhasil logout!");
    }

    public function viewRegister()
    {
        // Session::flush();
        $listJurusan = Jurusan::all();
        return view('pages.mahasiswa.register', compact("listJurusan"));
    }

    public function register(Request $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $telepon = $request->telepon;
        $tanggal_lahir = $request->tanggal_lahir;
        $jurusan = $request->jurusan;
        $angkatan = $request->angkatan;

        $listTeleponDosen = Dosen::get('dosen_telepon');
        $request->validate(
            [
                "nama" => ["required", new RuleNamaLengkap(), new RuleNamaLengkapVowel()],
                "email" => "required | email | unique:mahasiswa,mahasiswa_email",
                "telepon" => ["required", "numeric", "digits_between:10,12", "unique:mahasiswa,mahasiswa_telepon", new RuleNomorTelepon($listTeleponDosen, "dosen")],
                "tanggal_lahir" => "required | date | before:-18 years",
                "jurusan" => "required",
                "angkatan" => "required",
                "snk" => "accepted"
            ],
            [
                "required" => "Field wajib diisi!",
                "email" => "Email yang digunakan harus email valid!",
                "email.unique" => "Email harus unik!",
                "digits_between" => "Nomor telepon minimal 10 digit dan maksimal 12 digit!",
                "telepon.unique" => "Nomor telepon harus unik!",
                "before" => "Umur harus lebih dari 17 tahun!",
                "accepted" => "Konfirmasi syarat dan ketentuan harus tercentang!",
            ]
        );

        //NRP
        $splitTahun = str_split($angkatan);
        $nrp = $splitTahun[0] . $splitTahun[2] . $splitTahun[3];
        $jumlahMahasiswa = Mahasiswa::all()->count();
        $id = $jumlahMahasiswa + 1;
        for ($i = 0; $i < 3 - strlen($id); $i++) {
            $nrp .= "0";
        }
        $nrp .= $id;

        //PASSWORD
        $words = explode(' ', $nama);
        $yearFormat = date("Y", strtotime($tanggal_lahir));
        $year = str_split($yearFormat);
        $password = $words[count($words) - 1] . $year[count($year) - 2] . $year[count($year) - 1];

        //INSERT MAHASISWA
        $result = Mahasiswa::create([
            "mahasiswa_nrp" => $nrp,
            "mahasiswa_nama" => $nama,
            "mahasiswa_email" => $email,
            "mahasiswa_telepon" => $telepon,
            "mahasiswa_tanggal_lahir" => $tanggal_lahir,
            "jurusan_id" => $jurusan,
            "mahasiswa_angkatan" => $angkatan,
            "mahasiswa_password" => $password,
        ]);

        if ($result) {
            return back()->with("success", "Berhasil register mahasiswa!");
        } else {
            return back()->withInput()->with("message", "Gagal register mahasiswa!");
        }
    }
}
