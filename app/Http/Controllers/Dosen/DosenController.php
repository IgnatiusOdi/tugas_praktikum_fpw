<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
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
        return view('pages.dosen.register');
    }

    public function register(Request $request)
    {
        // Session::flush();
        $nama = $request->nama;
        $username = $request->username;
        $email = $request->email;
        $nomor = $request->nomor;
        $tanggal = $request->tanggal;
        $jurusan = $request->jurusan;
        $tahun = $request->tahun;
        $password = $request->password;
        $confirmation = $request->confirmation;
        $snk = $request->has('snk');

        //CEK FIELD KOSONG
        if (empty($nama) || empty($username) || empty($email) || empty($nomor) || empty($tanggal) || empty($jurusan) || empty($tahun) || empty($password) || empty($confirmation)) {
            return back()->withInput($request->input())->with("message", "Field tidak boleh kosong!");
        }

        //CEK SYARAT DAN KETENTUAN
        if (!$snk) {
            return back()->withInput($request->input())->with("message", "Syarat dan Ketentuan harus disetujui!");
        }

        //CEK USERNAME ADMIN
        if ($username == "admin") {
            return back()->withInput($request->input())->with("message", "Username tidak boleh admin!");
        }

        //CEK PASSWORD DAN CONFIRMATION
        if ($password != $confirmation) {
            return back()->withInput($request->input())->with("message", "Password dan confirmation harus sama!");
        }

        //CEK EMAIL / NOMOR TELEPON KEMBAR
        if (Session::has('listMahasiswa')) {
            foreach (Session::get('listMahasiswa') as $mahasiswa) {
                if ($mahasiswa['email'] == $email) {
                    return back()->withInput($request->input())->with("message", "Email harus unique!");
                } else if ($mahasiswa['nomor'] == $nomor) {
                    return back()->withInput($request->input())->with("message", "Nomor telepon harus unique!");
                }
            }
        }
        //+CEK USERNAME KEMBAR
        if (Session::has('listDosen')) {
            foreach (Session::get('listDosen') as $dosen) {
                if ($dosen['username'] == $username) {
                    return back()->withInput($request->input())->with("message", "Username harus unique!");
                } else if ($dosen['email'] == $email) {
                    return back()->withInput($request->input())->with("message", "Email harus unique!");
                } else if ($dosen['nomor'] == $nomor) {
                    return back()->withInput($request->input())->with("message", "Nomor telepon harus unique!");
                }
            }
        }

        Session::push('listDosen', [
            "username" => $username,
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
