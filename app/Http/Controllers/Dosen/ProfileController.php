<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Rules\RuleNomorTelepon;
use App\Rules\RulePassword;
use App\Rules\RuleUsername;
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

        //CARI INDEX DOSEN
        $index = -1;
        $listUser = Session::get('listUser');
        foreach ($listUser as $key => $user) {
            if ($user['role'] == 'dosen') {
                if ($user['nama'] == $nama) {
                    $index = $key;
                    break;
                }
            }
        }

        $request->validate(
            [
                "username" => ["required", "alpha_dash", "min:5", "max:10", new RuleUsername(Session::get('listUser'), $index)],
                "email" => "required | email",
                "nomor" => ["required", "numeric", "digits_between:10,12", new RuleNomorTelepon(Session::get('listUser'), $index)],
                "password" => ["required", "alpha_dash", "min:6", "max:12",  new RulePassword($request->username), "confirmed"],
                "password_confirmation" => "required",
            ]
        );

        //REPLACE DOSEN
        $dosen = $listUser[$index];
        $dosen["username"] = $request->username;
        $dosen["email"] = $request->email;
        $dosen["nomor"] = $request->nomor;
        $dosen["password"] = $request->password;
        $listUser[$index] = $dosen;

        //REPLACE SESSION
        Session::put('dosen', $dosen);
        Session::put('listDosen', $listUser);

        return back()->with("success", "Berhasil edit profile!");
    }
}
