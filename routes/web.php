<?php

//ADMIN
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\PeriodeController;

//DOSEN
use App\Http\Controllers\Dosen\DosenController;
use App\Http\Controllers\Dosen\HomeController as DosenHomeController;
use App\Http\Controllers\Dosen\KelasController as DosenKelasController;
use App\Http\Controllers\Dosen\ProfileController as DosenProfileController;

//MAHASISWA
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use App\Http\Controllers\Mahasiswa\HomeController as MahasiswaHomeController;
use App\Http\Controllers\Mahasiswa\KelasController as MahasiswaKelasController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;

use App\Http\Controllers\UserController;
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

//REDIRECT
Route::get('/', function () {
    return redirect()->route('login');
});

//LOGIN
Route::get('login', [UserController::class, 'viewLogin'])->name('login');
Route::post('login', [UserController::class, 'login'])->name('try-login');

//REGISTER
Route::prefix('register')->group(function () {
    Route::get('/', [MahasiswaController::class, 'viewRegister'])->name('register-mahasiswa');
    Route::post('/', [MahasiswaController::class, 'register'])->name('try-register-mahasiswa');
    Route::get('dosen', [DosenController::class, 'viewRegister'])->name('register-dosen');
    Route::post('dosen', [DosenController::class, 'register'])->name('try-register-dosen');
});

//ADMIN
Route::prefix('admin')->group(function () {
    //DASHBOARD
    Route::get('/', [AdminController::class, 'view'])->name('admin');
    Route::post('/', [AdminController::class, 'logout'])->name('admin-logout');
    //MATA KULIAH
    Route::prefix('matakuliah')->group(function () {
        Route::get('/', [MataKuliahController::class, 'view'])->name('admin-matakuliah');
        Route::post('tambah', [MataKuliahController::class, 'tambah'])->name('admin-tambah-matakuliah');
        Route::post('action', [MataKuliahController::class, 'action'])->name('admin-action-matakuliah');
    });
    //PERIODE
    Route::prefix('periode')->group(function () {
        Route::get('/', [PeriodeController::class, 'view'])->name('admin-periode');
        Route::post('tambah', [PeriodeController::class, 'tambah'])->name('admin-tambah-periode');
        Route::post('action', [PeriodeController::class, 'action'])->name('admin-action-periode');
    });
    //KELAS
    Route::prefix('kelas')->group(function () {
        Route::get('/', [AdminKelasController::class, 'view'])->name('admin-kelas');
        Route::post('tambah', [AdminKelasController::class, 'tambah'])->name('admin-tambah-kelas');
        Route::post('action', [AdminKelasController::class, 'action'])->name('admin-action-kelas');
    });
    // Route::get('dosen', [AdminDosenController::class, 'dosen'])->name('admin-dosen');
    // Route::get('mahasiswa', [AdminMahasiswaController::class, 'mahasiswa'])->name('admin-mahasiswa');
});

//DOSEN
Route::prefix('dosen')->group(function () {
    //HOME
    Route::get('/', [DosenHomeController::class, "view"])->name("dosen");
    Route::post('/', [DosenController::class, "logout"])->name("dosen-logout");
    //KELAS
    Route::get('kelas/{kode_periode?}', [DosenKelasController::class, 'view'])->name("dosen-kelas");
    //PROFILE
    Route::get('profile', [DosenProfileController::class, "view"])->name("dosen-profile");
    Route::post('profile', [DosenProfileController::class, "edit"])->name("dosen-edit-profile");
});

//MAHASISWA
Route::prefix('mahasiswa')->group(function () {
    //HOME
    Route::get('/', [MahasiswaHomeController::class, "view"])->name("mahasiswa");
    Route::post('/', [MahasiswaController::class, "logout"])->name("mahasiswa-logout");
    Route::post('join', [MahasiswaHomeController::class, 'join'])->name("mahasiswa-join-kelas");
    //KELAS
    Route::get('kelas/{kode_periode?}', [MahasiswaKelasController::class, 'view'])->name("mahasiswa-kelas");
    //PROFILE
    Route::get('profile', [MahasiswaProfileController::class, "view"])->name("mahasiswa-profile");
    Route::post('profile', [MahasiswaProfileController::class, "edit"])->name("mahasiswa-edit-profile");
});
