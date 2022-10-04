<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class MahasiswaController extends Controller
{
    public function logout()
    {
        Session::forget('mahasiswa');
        return redirect()->intended("login")->with("success", "Berhasil logout!");
    }

    public function viewRegister()
    {
        return view('pages.mahasiswa.register');
    }

    public function register(Request $request)
    {
        // Session::flush();
        $nama = $request->nama;
        $email = $request->email;
        $nomor = $request->nomor;
        $tanggal = $request->tanggal;
        $jurusan = $request->jurusan;
        $tahun = $request->tahun;
        $snk = $request->has('snk');

        //CEK FIELD KOSONG
        if (empty($nama) || empty($email) || empty($nomor) || empty($tanggal) || empty($jurusan) || empty($tahun)) {
            return back()->withInput()->with("message", "Field tidak boleh kosong!");
        }

        //CEK SYARAT DAN KETENTUAN
        if (!$snk) {
            return back()->withInput()->with("message", "Syarat dan Ketentuan harus disetujui!");
        }

        //CEK EMAIL / NOMOR TELEPON KEMBAR
        if (Session::has('listMahasiswa')) {
            foreach (Session::get('listMahasiswa') as $mahasiswa) {
                if ($mahasiswa['email'] == $email) {
                    return back()->withInput()->with("message", "Email harus unique!");
                } else if ($mahasiswa['nomor'] == $nomor) {
                    return back()->withInput()->with("message", "Nomor telepon harus unique!");
                }
            }
        }
        if (Session::has('listDosen')) {
            foreach (Session::get('listDosen') as $dosen) {
                if ($dosen['email'] == $email) {
                    return back()->withInput()->with("message", "Email harus unique!");
                } else if ($dosen['nomor'] == $nomor) {
                    return back()->withInput()->with("message", "Nomor telepon harus unique!");
                }
            }
        }

        //NRP
        $splitTahun = str_split($tahun);
        $nrp = $splitTahun[0] . $splitTahun[2] . $splitTahun[3];
        $id = 1;
        if (Session::has('listMahasiswa')) {
            foreach (Session::get('listMahasiswa') as $mahasiswa) {
                if (substr($mahasiswa["nrp"], 0, 3) == $nrp) {
                    $id += 1;
                }
            }
        }
        for ($i = 0; $i < 3 - strlen($id); $i++) {
            $nrp .= "0";
        }
        $nrp .= $id;

        //PASSWORD
        $words = explode(' ', $nama);
        $yearFormat = date("Y", strtotime($tanggal));
        $year = str_split($yearFormat);
        $password = $words[count($words) - 1] . $year[count($year) - 2] . $year[count($year) - 1];

        Session::push('listMahasiswa', [
            "nrp" => $nrp,
            "nama" => $nama,
            "email" => $email,
            "nomor" => $nomor,
            "tanggal" => $tanggal,
            "jurusan" => $jurusan,
            "tahun" => $tahun,
            "password" => $password,
        ]);
        return back()->with("success", "Berhasil register!");
    }
}
