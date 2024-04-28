<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/add_word', [WordController::class, 'store'])->name('add_word');
    Route::get('/dashboard', [WordController::class, 'index'])->name('dashboard');
    Route::delete('/delete_word/{word}', [WordController::class, 'destroy'])->name('word.delete_word');
    Route::get('/delete_word/{word}', [WordController::class, 'destroy'])->name('word.delete_word');
    Route::get('/edit_word/{word}', [WordController::class, 'edit'])->name('edit_word');
    Route::put('/edit_word/{word}', [WordController::class , 'update'])->name('word.update');
});

require __DIR__.'/auth.php';
