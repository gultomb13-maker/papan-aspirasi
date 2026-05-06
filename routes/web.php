<?php

use App\Http\Controllers\AspirationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Halaman Utama (Daftar Aspirasi)
Route::get('/', [AspirationController::class, 'index'])->name('aspirations.index');

// Halaman Form Tambah Aspirasi
Route::get('/aspirations/create', [AspirationController::class, 'create'])->name('aspirations.create');

// Proses Simpan Aspirasi
Route::post('/aspirations', [AspirationController::class, 'store'])->name('aspirations.store');

// Route bawaan starter kit (Dashboard & Auth)
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';