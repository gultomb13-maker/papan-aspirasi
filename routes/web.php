<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AspirationController;
use App\Http\Controllers\VoteController;

Route::resource('aspirations', AspirationController::class);

Route::get('/', [AspirationController::class, 'index'])
    ->name('aspirations.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/aspirations/{aspiration}/vote', [VoteController::class, 'toggle'])
    ->middleware('auth')
    ->name('aspirations.vote');
require __DIR__.'/auth.php';
