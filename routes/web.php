<?php

//use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScholarshipController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [ScholarshipController::class, 'index'])
    ->name('scholarships.index');

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/saved', [ScholarshipController::class, 'saved'])
        ->name('scholarships.saved');
        Route::post('/scholarships/{scholarship}/save', [ScholarshipController::class, 'toggleSave'])
        ->name('scholarships.toggleSave');
    });

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
