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
});
