<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\ItRequestController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard',[ItRequestController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Pages Route

Route::get('/pages/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('pages.dashboard');

Route::get('/pages/requestform', function () {
    return view('pages.requestform');
})->middleware(['auth', 'verified'])->name('pages.requestform');

Route::get('/pages/requestlist', function () {
    return view('pages.requestlist');
})->middleware(['auth', 'verified'])->name('pages.requestlist');

// Create Request 

Route::post('pages/request/store',[ItRequestController::class,'store']);

// Change Status

Route::put('/requests/{id}/status', [ItRequestController::class, 'updateStatus'])
     ->name('requests.updateStatus');

require __DIR__.'/auth.php';
