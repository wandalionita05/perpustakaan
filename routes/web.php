<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;

Route::get('/', [PeminjamanController::class, 'index']);
Route::post('/pinjam', [PeminjamanController::class, 'store'])->name('pinjam.store');