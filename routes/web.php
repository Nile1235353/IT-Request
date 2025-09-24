<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pages\ItRequestController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\UserController;

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

Route::post('pages/request/store',[ItRequestController::class,'store'])->middleware(['auth', 'verified']);
Route::post('pages/request/softwareStore',[ItRequestController::class,'softwareStore'])->middleware(['auth', 'verified']);
Route::post('pages/request/datacenterStore',[ItRequestController::class,'dataCenterStore'])->middleware(['auth', 'verified']);

// Change Status

Route::put('/requests/{id}/status', [ItRequestController::class, 'updateStatus'])->middleware(['auth', 'verified'])
     ->name('requests.updateStatus');
Route::put('/requests/{id}/softwareStatus', [ItRequestController::class, 'softwareUpdateStatus'])->middleware(['auth', 'verified'])
     ->name('requests.softwareStatus');
Route::put('/requests/{id}/dataCenterStatus', [ItRequestController::class, 'dataCenterUpdateStatus'])->middleware(['auth', 'verified'])
        ->name('requests.dataCenterStatus');

// Dashboard Status Filter

Route::get('/dashboard/stats', [App\Http\Controllers\RequestController::class, 'dashboardStats'])->middleware(['auth', 'verified']);


// Register Route - Only accessible by admin users

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware(['auth', 'verified'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Update Request Data Form

Route::put('/requests/{id}/update-description', [ItRequestController::class, 'updateDescription'])->middleware(['auth', 'verified'])
->name('requests.updateDescription');

Route::put('/requests/{id}/update-category', [ItRequestController::class, 'updateCategory'])->middleware(['auth', 'verified'])
->name('requests.updateCategory');
// Route for updating location
Route::put('/requests/{id}/location', [ItRequestController::class, 'updateLocation'])->middleware(['auth', 'verified'])
->name('requests.updateLocation');
// Route for updating remark/comment
Route::put('/requests/{id}/remark', [ItRequestController::class, 'updateRemark'])->middleware(['auth', 'verified'])
->name('requests.updateRemark');
// Route for updating Data Center remark/comment
Route::put('/requests/{id}/DataCenterRemark', [ItRequestController::class, 'DataCenterUpdateRemark'])->middleware(['auth', 'verified'])
->name('requests.DataCenterUpdateRemark');

// For Data Center
Route::put('/requests/{id}/datacenterUpdate-category', [ItRequestController::class, 'DataCenterupdateCategory'])->middleware(['auth', 'verified'])
->name('requests.DataCenterUpdateCategory');
Route::put('/requests/{id}/datacenterUpdate-description', [ItRequestController::class, 'DataCenterUpdateDescription'])->middleware(['auth', 'verified'])
->name('requests.DataCenterUpdateDescription');

//Setting Dashboard 

// Route::get('/settingDashboard', function () {
//     return view('settingdashboard');
// });

// // User List
// Route::get('/users',[UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');

// // User Edit Form
// Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');

// // User Update Action
// Route::put('/users/{id}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');

// Route::middleware(['auth', 'admin'])->group(function() {
//     Route::get('/register', [RegisterController::class, 'create'])->name('register');
//     Route::post('/register', [RegisterController::class, 'store']);
// });

require __DIR__.'/auth.php';
