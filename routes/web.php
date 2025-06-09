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
