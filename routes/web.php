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

/* Login */
Route::get('/login', function () {
    return view('pages.auth.login');
});