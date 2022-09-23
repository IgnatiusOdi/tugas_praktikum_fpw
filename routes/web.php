<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("login");
});
Route::get('login', function () {
    return view('login');
})->name('login');
Route::prefix('register')->group(function () {
    Route::get('/', function () {
        return view('pages.mahasiswa.register');
    });
    Route::get('dosen', function () {
        return view('pages.dosen.register');
    });
});
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('pages.admin.home');
    });
    Route::get('dosen', function () {
        return view('pages.admin.dosen');
    });
    Route::get('mahasiswa', function () {
        return view('pages.admin.mahasiswa');
    });
});
Route::prefix('dosen')->group(function () {
    Route::get('/', function () {
        return view('pages.dosen.home');
    });
    Route::get('profile', function () {
        return view('pages.dosen.profile');
    });
});
Route::prefix('mahasiswa')->group(function () {
    Route::get('/', function () {
        return view('pages.mahasiswa.home');
    });
    Route::get('profile', function () {
        return view('pages.mahasiswa.profile');
    });
});
