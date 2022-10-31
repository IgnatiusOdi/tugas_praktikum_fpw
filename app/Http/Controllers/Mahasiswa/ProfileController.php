<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Rules\RuleNomorTelepon;
use App\Rules\RulePassword;
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
        $username = $request->username;

        //CARI INDEX MAHASISWA
        $index = -1;
        $listUser = Session::get('listUser');
        foreach ($listUser as $key => $user) {
            if ($user['role'] == 'mahasiswa') {
                if ($user['username'] == $username) {
                    $index = $key;
                    break;
                }
            }
        }

        $request->validate(
            [
                "email" => "required | email",
                "nomor" => ["required", "numeric", "digits_between:10,12", new RuleNomorTelepon(Session::get('listUser'), $index)],
                "password" => ["required", "alpha_dash", "min:6", "max:12",  new RulePassword($request->username), "confirmed"],
                "password_confirmation" => "required",
            ]
        );

        //REPLACE MAHASISWA
        $mahasiswa = $listUser[$index];
        $mahasiswa['email'] = $request->email;
        $mahasiswa['nomor'] = $request->nomor;
        $mahasiswa['password'] = $request->password;
        $listUser[$index] = $mahasiswa;

        //REPLACE SESSION
        Session::put('mahasiswa', $mahasiswa);
        Session::put('listMahasiswa', $listUser);

        return back()->with("success", "Berhasil edit profile!");
    }
}
