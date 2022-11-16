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
use App\Http\Controllers\Mahasiswa\FindController as MahasiswaFindController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//REDIRECT
Route::get('/', function () {
    return redirect()->route('view-login');
});

//LOGIN
Route::prefix('login')->group(function () {
    Route::get('/', [UserController::class, 'viewLogin'])->name('view-login');
    Route::post('/', [UserController::class, 'login'])->name('login');
});

//REGISTER
Route::prefix('register')->group(function () {
    //MAHASISWA
    Route::get('/', [MahasiswaController::class, 'viewRegister'])->name('view-register-mahasiswa');
    Route::post('/', [MahasiswaController::class, 'register'])->name('register-mahasiswa');
    //DOSEN
    Route::prefix('dosen')->group(function () {
        Route::get('/', [DosenController::class, 'viewRegister'])->name('view-register-dosen');
        Route::post('/', [DosenController::class, 'register'])->name('register-dosen');
    });
});

//ADMIN
Route::prefix('admin')->group(function () {
    //DASHBOARD
    Route::get('/', [AdminController::class, 'view'])->name('admin');
    Route::post('/', [AdminController::class, 'logout'])->name('admin-logout');
    //BAN
    Route::prefix('ban')->group(function () {
        //DOSEN
        Route::post('dosen/{id}', [AdminController::class, 'banDosen'])->name('admin-ban-dosen');
        //MAHASISWA
        Route::post('mahasiswa/{id}', [AdminController::class, 'banMahasiswa'])->name('admin-ban-mahasiswa');
    });
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
Route::prefix('dosen')->middleware(['CekRole:dosen'])->group(function () {
    //HOME
    Route::get('/', [DosenHomeController::class, "view"])->name("dosen")->middleware('Logging:Akses Home');
    Route::post('/', [DosenController::class, "logout"])->name("dosen-logout")->middleware("Logging:Logout");
    //KELAS
    Route::prefix('kelas')->group(function () {
        // Route::get('kelas/{kode_periode?}', [DosenKelasController::class, 'view'])->name("dosen-kelas-periode");
        Route::get('/', [DosenKelasController::class, 'view'])->name("dosen-kelas")->middleware('Logging:Akses Kelas');
        Route::get('{id}', [DosenKelasController::class, 'detail'])->name('dosen-kelas-detail')->middleware('Logging:Akses Detail Kelas');
        //ABSENSI
        Route::post('{id}', [DosenKelasController::class, 'actionAbsensi'])->name('dosen-kelas-action-absensi')->middleware('Logging:Action Absensi');
        Route::get('{id}/absensi/{absensi?}', [DosenKelasController::class, 'absensi'])->name('dosen-kelas-absensi')->middleware('Logging:Akses Absensi');
        Route::post('{id}/absensi/{absensi?}', [DosenKelasController::class, 'createAbsensi'])->name('dosen-kelas-create-absensi')->middleware('Logging:Create Absensi');
        //PENGUMUMAN
        Route::get('{id}/pengumuman', [DosenKelasController::class, 'pengumuman'])->name('dosen-kelas-pengumuman')->middleware('Logging:Akses Pengumuman');
        Route::post('id}/pengumuman', [DosenKelasController::class, 'createPengumuman'])->name('dosen-kelas-create-pengumuman')->middleware('Logging:Create Pengumuman');
        //MODULE
        Route::get('{id}/module', [DosenKelasController::class, 'module'])->name('dosen-kelas-module')->middleware('Logging:Akses Module');
        Route::post('{id}/module', [DosenKelasController::class, 'createModule'])->name('dosen-kelas-create-module')->middleware('Logging:Create Module');
        Route::get('{id}/module/{module}', [DosenKelasController::class, 'detailModule'])->name('dosen-kelas-detail-module')->middleware('Logging:Detail Module');
        Route::post('{id}/module/{module}', [DosenKelasController::class, 'actionModule'])->name('dosen-kelas-action-module')->middleware('Logging:Action Module');
    });
    //PROFILE
    Route::prefix('profile')->group(function () {
        Route::get('/', [DosenProfileController::class, "view"])->name("dosen-profile")->middleware('Logging:Akses Profile');
        Route::post('/', [DosenProfileController::class, "edit"])->name("dosen-edit-profile")->middleware('Logging:Edit Profile');
    });
});

//MAHASISWA
Route::prefix('mahasiswa')->middleware(['CekRole:mahasiswa'])->group(function () {
    //HOME
    Route::get('/', [MahasiswaHomeController::class, "view"])->name("mahasiswa")->middleware('Logging:Akses Home');
    Route::post('/', [MahasiswaController::class, "logout"])->name("mahasiswa-logout")->middleware('Logging:Logout');
    //MODULE
    Route::prefix('module')->group(function () {
        Route::get('{id}', [MahasiswaHomeController::class, "viewModule"])->name("mahasiswa-view-module")->middleware('Logging:Lihat Module');
        Route::post('{id}', [MahasiswaHomeController::class, "submit"])->name("mahasiswa-submit-module")->middleware('Logging:Submit Module');
    });
    //KELAS
    Route::post('join', [MahasiswaHomeController::class, 'join'])->name("mahasiswa-join-kelas")->middleware('Logging:Join Kelas');
    Route::prefix('kelas')->group(function () {
        // Route::get('kelas/{kode_periode?}', [MahasiswaKelasController::class, 'view'])->name("mahasiswa-kelas-periode");
        Route::get('/', [MahasiswaKelasController::class, 'view'])->name("mahasiswa-kelas")->middleware('Logging:Akses Kelas');
        Route::get('{id}', [MahasiswaKelasController::class, "detail"])->name('mahasiswa-kelas-detail')->middleware('Logging:Akses Detail Kelas');
    });
    //PROFILE
    Route::prefix('profile')->group(function () {
        Route::get('/', [MahasiswaProfileController::class, "view"])->name("mahasiswa-profile")->middleware('Logging:Akses Profile');
        Route::post('/', [MahasiswaProfileController::class, "edit"])->name("mahasiswa-edit-profile")->middleware('Logging:Edit Profile');
    });
    //CARI PROFILE
    Route::prefix('find')->group(function () {
        Route::get('/', [MahasiswaFindController::class, "view"])->name('mahasiswa-find')->middleware("Logging:Cari Profile");
        Route::get('dosen/{id?}', [MahasiswaFindController::class, "viewDosen"])->name('mahasiswa-find-dosen')->middleware("Logging: Cari Dosen");
        Route::get('mahasiswa/{id?}', [MahasiswaFindController::class, "viewMahasiswa"])->name('mahasiswa-find-teman')->middleware("Logging: Cari Teman");
    });
});
