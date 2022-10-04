<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function view()
    {
        return view("pages.mahasiswa.profile");
    }

    public function edit(Request $request)
    {
        $nrp = $request->nrp;
        $email = $request->email;
        $nomor = $request->nomor;
        $password = $request->password;
        $confirmation = $request->confirmation;

        $index = -1;
        $listMahasiswa = Session::get('listMahasiswa');

        //CEK FIELD KOSONG
        if (empty($email) || empty($nomor) || empty($password) || empty($confirmation)) {
            return back()->with("message", "Field tidak boleh kosong!");
        }

        //CEK PASSWORD DAN CONFIRMATION
        if ($password != $confirmation) {
            return back()->with("message", "Password dan Confirm Password harus sama!");
        }

        //CARI INDEX MAHASISWA
        foreach ($listMahasiswa as $key => $mahasiswa) {
            if ($mahasiswa['nrp'] == $nrp) {
                $index = $key;
                break;
            }
        }

        //CEK EMAIL / NOMOR TELEPON KEMBAR
        foreach ($listMahasiswa as $key => $mahasiswa) {
            if ($key != $index) {
                if ($mahasiswa['email'] == $email) {
                    return back()->with("message", "Email harus unique!");
                } else if ($mahasiswa['nomor'] == $nomor) {
                    return back()->with("message", "Nomor telepon harus unique!");
                }
            }
        }
        foreach (Session::get('listDosen') as $key => $dosen) {
            if ($dosen['email'] == $email) {
                return back()->with("message", "Email harus unique!");
            } else if ($dosen['nomor'] == $nomor) {
                return back()->with("message", "Nomor telepon harus unique!");
            }
        }

        $mahasiswa = $listMahasiswa[$index];
        $mahasiswa['email'] = $email;
        $mahasiswa['nomor'] = $nomor;
        $mahasiswa['password'] = $password;
        $listMahasiswa[$index] = $mahasiswa;

        Session::put('listMahasiswa', $listMahasiswa);
        Session::put('mahasiswa', $mahasiswa);
        return back()->with("success", "Berhasil edit profile!");
    }
}
