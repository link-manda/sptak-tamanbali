<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/keuangan', [PublicController::class, 'keuangan'])->name('keuangan');
Route::get('/surat', [PublicController::class, 'surat'])->name('surat');
Route::get('/profil-desa', [PublicController::class, 'profil'])->name('profil');
Route::get('/susunan-prajuru', [PublicController::class, 'prajuru'])->name('prajuru');
Route::get('/awig-awig', [PublicController::class, 'awig'])->name('awig');
Route::get('/pararem', [PublicController::class, 'pararem'])->name('pararem');