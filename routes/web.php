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
});
