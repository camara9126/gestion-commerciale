<?php

use App\Http\Controllers\EntrepriseControleer;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return view('dashboard');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'entreprise.exists'])->group(function () {
    Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
});

// Route Entreprise
Route::middleware(['auth'])->group(function () {
    Route::get('entreprise/create', [EntrepriseControleer::class, 'create'])->name('entreprise.create');
    Route::post('entreprise/store', [EntrepriseControleer::class, 'store'])->name('entreprise.store');
});



















require __DIR__.'/auth.php';
