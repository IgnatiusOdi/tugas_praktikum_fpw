<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function view()
    {
        return view("pages.dosen.profile");
    }

    public function edit(Request $request)
    {
        $nama = $request->nama;
        $username = $request->username;
        $email = $request->email;
        $nomor = $request->nomor;
        $password = $request->password;
        $confirmation = $request->confirmation;

        $index = -1;
        $listDosen = Session::get('listDosen');

        //CEK FIELD KOSONG
        if (empty($username) || empty($email) || empty($nomor) || empty($password) || empty($confirmation)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }

        //CEK USERNAME ADMIN
        if ($username == "admin") {
            return back()->with("message", "Username tidak boleh admin!");
        }

        //CEK PASSWORD DAN CONFIRMATION
        if ($password != $confirmation) {
            return back()->with("message", "Password dan Confirm Password harus sama!");
        }

        //CARI INDEX DOSEN
        foreach ($listDosen as $key => $dosen) {
            if ($dosen['nama'] == $nama) {
                $index = $key;
                break;
            }
        }

        //CEK EMAIL / NOMOR TELEPON KEMBAR
        foreach (Session::get('listMahasiswa') as $mahasiswa) {
            if ($mahasiswa['email'] == $email) {
                return back()->with("message", "Email harus unique!");
            } else if ($mahasiswa['nomor'] == $nomor) {
                return back()->with("message", "Nomor telepon harus unique!");
            }
        }
        //+CEK USERNAME KEMBAR TANPA INDEX
        foreach ($listDosen as $key => $dosen) {
            if ($key != $index) {
                if ($dosen['username'] == $username) {
                    return back()->with("message", "Username harus unique!");
                } else if ($dosen['email'] == $email) {
                    return back()->with("message", "Email harus unique!");
                } else if ($dosen['nomor'] == $nomor) {
                    return back()->with("message", "Nomor telepon harus unique!");
                }
            }
        }

        $dosen = $listDosen[$index];
        $dosen["username"] = $username;
        $dosen["email"] = $email;
        $dosen["nomor"] = $nomor;
        $dosen["password"] = $password;
        $listDosen[$index] = $dosen;

        Session::put('listDosen', $listDosen);
        Session::put('dosen', $dosen);
        return back()->with("success", "Berhasil edit profile!");
    }
}
