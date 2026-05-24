<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

// Rute Beranda (Sudah ada sebelumnya)
Route::get('/', [BarangController::class, 'index']);

Route::get('/cara-kerja', function () {
    return view('carakerja'); // Nama file tanpa .blade.php
});

// RUTE BARU UNTUK CRUD ELOQUENT
Route::get('/kelola', [BarangController::class, 'kelola']); // Menampilkan Form & Tabel
Route::post('/kelola/store', [BarangController::class, 'store']); // Create Data
Route::get('/kelola/edit/{id}', [BarangController::class, 'edit']); // Menampilkan Form Edit
Route::post('/kelola/update/{id}', [BarangController::class, 'update']); // Update Data
Route::get('/kelola/delete/{id}', [BarangController::class, 'destroy']); // Delete Data
Route::get('/lapor', [BarangController::class, 'lapor']); // Halaman Form Publik