<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\BukuController;

// Fitur Peminjaman
Route::get('/', [PeminjamanController::class, 'index'])->name('home');
Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');

// Fitur Riwayat & Pengembalian
Route::get('/riwayat', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
Route::post('/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');

// Fitur Manajemen Buku
Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');