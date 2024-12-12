<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuController;
use App\Http\Controllers\PenyetujuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use Livewire\Livewire;

use App\Http\Livewire\PengajuanForm;
use App\Http\Livewire\InputPegawaiForm;
use App\Http\Livewire\PengaduanForm;
use App\Http\Livewire\PenyetujuDetail;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

// Pengaju
Route::middleware(['auth', 'pengajuMiddleware'])->group(function () {
    Route::get('/pengaju', [PengajuController::class, 'riwayatCuti'])->name('pengaju.riwayat');
    Route::get('/pengajuan-form', PengajuanForm::class)->name('pengajuan.form');
    Route::get('/pengaju/pengaduan-form', PengaduanForm::class)->name('pengaju.pengaduan.form');
});

// Penyetuju
Route::middleware(['auth', 'penyetujuMiddleware'])->group(function () {
    Route::get('/penyetuju', [PenyetujuController::class, 'daftarCuti'])->name('penyetuju.daftar-cuti');
    Route::get('/penyetuju/penyetuju-detail', PenyetujuDetail::class)->name('penyetuju.penyetuju-detail');
    Route::get('/penyetuju/pengaduan-form', PengaduanForm::class)->name('penyetuju.pengaduan.form');
});

// Admin
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin', [AdminController::class, 'menuPengaduan'])->name('admin.menu-pengaduan');
    Route::get('/daftar-pegawai', [AdminController::class, 'daftarPegawai'])->name('admin.daftar-pegawai');
    Route::get('/input-pegawai', InputPegawaiForm::class)->name('admin.input-pegawai');
});
