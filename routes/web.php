<?php

use Illuminate\Support\Facades\Route;

/* Admin */
Route::get('/', function () {
    return view('pages.admin.dashboard.index');
});
// Route::get('/guru', function () {
//     return view('pages.admin.guru.index');
// });
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

/* THQ */
Route::get('/thq', function () {
    return view('pages.thq.index');
});

//untuk yang belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.store');
});

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

//untuk yang sudah login
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/guru', App\Http\Controllers\GuruController::class)->names('guru');
        Route::get('/guru/{id}/jabatan', [App\Http\Controllers\GuruController::class, 'jabatan'])->name('guru.jabatan');

        Route::resource('/pengguna', App\Http\Controllers\PenggunaController::class)->names('pengguna');
        Route::get('/formulir/pengisi', [App\Http\Controllers\FormPenilaianController::class, 'formPengisi'])->name('formulir.pengisi');
        Route::get('/formulir/{id}/jabatan', [App\Http\Controllers\FormPenilaianController::class, 'jabatan'])->name('formulir.jabatan');
        Route::resource('/formulir', App\Http\Controllers\FormPenilaianController::class)->names('formulir');
        Route::resource('/jabatan', App\Http\Controllers\JabatanController::class)->names('jabatan');
        Route::get('/target/jabatan', [App\Http\Controllers\JabatanController::class, 'target'])->name('jabatan.target');

        // routes/api.php
        Route::get('/target/{target}/detail', function (App\Models\User $target, Illuminate\Http\Request $request) {
            $pengisi_id = $request->input('pengisi_id'); // Changed from query() to input()

            $target->load(['jabatans.jabatan']);

            $nilai = $target->nilaiAsTarget()
                ->where('pengisi_id', $pengisi_id)
                ->with(['penilaian.form', 'penilaian.kategori', 'penilaian.subKategori'])
                ->orderBy('created_at', 'desc')
                ->get();

            $target->total_penilaian = $nilai->count();
            $target->rata_nilai      = $nilai->avg('nilai');
            $target->jabatan_list    = $target->jabatans->map(function ($jabatanUser) {
                return $jabatanUser->jabatan->nama;
            })->implode(', ');

            return response()->json([
                'target' => $target,
                'nilai'  => $nilai,
            ]);
        });

        Route::resource('/pengisi', controller: App\Http\Controllers\FormPengisiController::class)->names('pengisi');
        Route::get('/pengisi/saveUpdate', [App\Http\Controllers\FormPengisiController::class, 'update'])->name('pengisi.update.save');
        Route::get('/pengisi/{tahun}/{semester}/{form}/{id}/edit', [App\Http\Controllers\FormPengisiController::class, 'edit'])->name('pengisi.edit.nilai');
        Route::delete('/pengisi/{tahun}/{semester}/{form}/{id}/delete', [App\Http\Controllers\FormPengisiController::class, 'destroy'])->name('pengisi.destroy.nilai');
        Route::get('/form/{form}/detail', function (App\Models\Form $form) {
            $nilai = $form->nilai()
                ->where('pengisi_id', auth()->id())
                ->with(['penilaian', 'target'])
                ->get();

            return response()->json([
                'form'  => $form,
                'nilai' => $nilai,
            ]);
        });

        Route::resource('/tipe-penilaian', App\Http\Controllers\PenilaianTipeController::class)->names('tipe-penilaian');
        Route::resource('/opsi-penilaian', App\Http\Controllers\PenilaianOpsiController::class)->names('opsi-penilaian');
    });
});

Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/', [App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/penilaian', App\Http\Controllers\Guru\PenilaianController::class)->names('penilaian');
    Route::get('/jabatan/target', [App\Http\Controllers\Guru\JabatanController::class, 'target'])->name('jabatan.target');
    Route::get('/jabatan/{id}/form', [App\Http\Controllers\Guru\JabatanController::class, 'form'])->name('jabatan.form');
    Route::get('/jabatan/{id}/guru/{formId}', [App\Http\Controllers\Guru\JabatanController::class, 'guru'])->name('jabatan.guru');

    Route::get('/form/{id}', [App\Http\Controllers\Guru\FormController::class, 'show'])->name('form.show');
});

/* Kepsek */
