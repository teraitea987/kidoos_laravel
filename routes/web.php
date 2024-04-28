<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

    Route::get('/french_choose', [WordController::class, 'french_choose'])->name('french_choose');
    Route::get('/french_easy', [WordController::class, 'french_easy'])->name('french_easy');
    Route::get('/french_medium', [WordController::class, 'french_medium'])->name('french_medium');
    Route::get('/french_hard', [WordController::class, 'french_hard'])->name('french_hard');

    Route::get('api_get_words', [WordController::class, 'api_get_words'])->name('api_get_words');
});

require __DIR__.'/auth.php';
