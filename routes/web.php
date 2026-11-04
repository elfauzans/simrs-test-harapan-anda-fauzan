<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'tampilkan'])->name('dashboard');

Route::controller(PasienController::class)->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/', 'daftar')->name('daftar');
    Route::get('/tambah', 'tambah')->name('tambah');
    Route::post('/', 'simpan')->name('simpan');
    Route::get('/{pasien}', 'detail')->name('detail');
    Route::get('/{pasien}/ubah', 'ubah')->name('ubah');
    Route::put('/{pasien}', 'perbarui')->name('perbarui');
    Route::delete('/{pasien}', 'hapus')->name('hapus');
});

Route::controller(DokterController::class)->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/', 'daftar')->name('daftar');
    Route::get('/tambah', 'tambah')->name('tambah');
    Route::post('/', 'simpan')->name('simpan');
    Route::get('/{dokter}', 'detail')->name('detail');
    Route::get('/{dokter}/ubah', 'ubah')->name('ubah');
    Route::put('/{dokter}', 'perbarui')->name('perbarui');
    Route::delete('/{dokter}', 'hapus')->name('hapus');
});

Route::controller(PendaftaranController::class)->prefix('pendaftaran')->name('pendaftaran.')->group(function () {
    Route::get('/', 'daftar')->name('daftar');
    Route::get('/tambah', 'tambah')->name('tambah');
    Route::post('/', 'simpan')->name('simpan');
    Route::get('/{pendaftaran}', 'detail')->name('detail');
    Route::get('/{pendaftaran}/ubah', 'ubah')->name('ubah');
    Route::put('/{pendaftaran}', 'perbarui')->name('perbarui');
    Route::delete('/{pendaftaran}', 'hapus')->name('hapus');
});
