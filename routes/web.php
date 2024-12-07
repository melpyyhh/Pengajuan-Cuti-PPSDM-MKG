<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuController;
use App\Http\Controllers\PenyetujuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Livewire\Livewire;

use App\Http\Livewire\PengajuanForm;

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
    Route::get('/pengaju', [PengajuController::class, 'riwayatCuti'])->name('pengaju.riwayat');
    Route::get('/pengajuan-form', PengajuanForm::class)->name('pengajuan.form');
});

Route::middleware(['auth', 'penyetujuMiddleware'])->group(function () {
    Route::get('/penyetuju', [PenyetujuController::class, 'daftarCuti'])->name('penyetuju.riwayat');
});

Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin', [AdminController::class, 'menuPengaduan'])->name('admin.menu-pengaduan');
    Route::get('/input-pegawai', \App\Http\Livewire\InputPegawaiForm::class)->name('admin.input-pegawai.form');
});
