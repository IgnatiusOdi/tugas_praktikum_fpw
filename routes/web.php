<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'redirectToLogin']);
Route::get('login', [PageController::class, 'login'])->name('login');
Route::post("login", [UserController::class, 'login'])->name('try-login');
Route::prefix('register')->group(function () {
    Route::get('/', [MahasiswaController::class, 'register'])->name('register-mahasiswa');
    Route::get('dosen', [DosenController::class, 'register'])->name('register-dosen');
});
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('dosen', [AdminController::class, 'dosen'])->name('admin-dosen');
    Route::get('mahasiswa', [AdminController::class, 'mahasiswa'])->name('admin-mahasiswa');
});
Route::prefix('dosen')->group(function () {
    Route::get('/', [DosenController::class, "home"])->name("dosen-home");
    Route::get('profile', [DosenController::class, "profile"])->name("dosen-profile");
});
Route::prefix('mahasiswa')->group(function () {
    Route::get('/', [MahasiswaController::class, "home"])->name("mahasiswa-home");
    Route::get('profile', [MahasiswaController::class, "profile"])->name("mahasiswa-profile");
});
