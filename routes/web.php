<?php

use Illuminate\Support\Facades\Route;

/* Admin */
Route::get('/', function () {
    return view('pages.admin.dashboard.index');
});
Route::get('/guru', function () {
    return view('pages.admin.guru.index');
});
Route::get('/rapor', function () {
    return view('pages.admin.rapor.index');
});
Route::get('/penilaian', function () {
    return view('pages.admin.penilaian.index');
});
Route::get('/form', function () {
    return view('pages.admin.formulir.index');
});
/* Guru */
Route::get('/beranda', function () {
    return view('pages.guru.beranda.index');
});
Route::get('/kesolehan', function () {
    return view('pages.guru.formulir.kesolehan');
});
Route::get('/super-visi', function () {
    return view('pages.guru.formulir.super-visi');
});
Route::get('/profile', function () {
    return view('pages.guru.profil.index');
});

/* wakasek */
Route::get('/wakasek', function () {
    return view('pages.wakasek.beranda.index');
});
Route::get('/wakasek-p1', function () {
    return view('pages.wakasek.formulir.prestasi1');
});
Route::get('/wakasek-p2', function () {
    return view('pages.wakasek.formulir.prestasi2');
});

/* THQ */
Route::get('/thq', function () {
    return view('pages.thq.index');
});

//untuk yang belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.store');
});

//untuk yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::resource('/guru', App\Http\Controllers\GuruController::class)->names('guru');
    Route::resource('/pengguna', App\Http\Controllers\PenggunaController::class)->names('pengguna');
    Route::resource('/formulir', App\Http\Controllers\FormController::class)->names('formulir');
    Route::resource('/jabatan', App\Http\Controllers\JabatanController::class)->names('jabatan');

    Route::resource('/tipe-penilaian', App\Http\Controllers\PenilaianTipeController::class)->names('tipe-penilaian');
    Route::resource('/opsi-penilaian', App\Http\Controllers\PenilaianOpsiController::class)->names('opsi-penilaian');
});

/* Kepsek */
Route::get('/kepsek', function () {
    return view('pages.kepsek.beranda.index');
});
Route::get('/kepsek-pengisian', function () {
    return view('pages.kepsek.formulir.index');
});
Route::get('/list-guru', function () {
    return view('pages.kepsek.list-guru.index');
});

/* Statistik untuk selain admin*/
Route::get('/statistik', function () {
    return view('pages.statistik.index');
});
