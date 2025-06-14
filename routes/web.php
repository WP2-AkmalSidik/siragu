<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.admin.dashboard.index');
});
Route::get('/guru', function () {
    return view('pages.admin.guru.index');
});
Route::get('/beranda', function () {
    return view('pages.guru.beranda.index');
});
Route::get('/formulir', function () {
    return view('pages.guru.formulir.index');
});
Route::get('/penilaian', function () {
    return view('pages.admin.penilaian.index');
});
Route::get('/rapor', function () {
    return view('pages.admin.rapor.index');
});
