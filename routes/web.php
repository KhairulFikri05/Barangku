<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

// Jalankan BarangController saat halaman utama diakses
Route::get('/', [BarangController::class, 'index']);