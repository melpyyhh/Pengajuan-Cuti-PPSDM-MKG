<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuController;
use App\Http\Controllers\PenyetujuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';


Route::middleware(['auth', 'pengajuMiddleware'])->group(function () {
    Route::get('/pengaju', [PengajuController::class, 'index'])->name('pengaju.dashboard');
});

Route::middleware(['auth', 'penyetujuMiddleware'])->group(function () {
    Route::get('/penyetuju', [PenyetujuController::class, 'index'])->name('penyetuju.dashboard');
});

Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});
