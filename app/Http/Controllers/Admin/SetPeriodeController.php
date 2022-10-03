<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SetPeriodeController extends Controller
{
    public function view()
    {
        return view('pages.admin.setperiode');
    }
}
