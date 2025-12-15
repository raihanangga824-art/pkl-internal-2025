<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tentang', function () {
    // ================================================
    // Route::get() = Tangani HTTP GET request
    // '/tentang'   = URL yang akan dihandle
    // function     = Kode yang dijalankan saat URL diakses
    // ================================================

    return view('tentang');
    // ↑ return view('tentang') = Tampilkan file tentang.blade.php
    // ↑ Laravel akan mencari di: resources/views/tentang.blade.php
});


 Route::get('/sapa/{nama}', function ($nama) {
    return "Halo, $nama! Selamat datang di Toko Online Raihan.";
});

Route::get('/kategori/{nama?}', function ($nama = 'Semua') {
    // ↑ {nama?} = Tanda ? berarti parameter OPSIONAL
    // ↑ $nama = 'Semua' = Nilai default jika parameter tidak diberikan

    return "Menampilkan kategori: $nama";
});