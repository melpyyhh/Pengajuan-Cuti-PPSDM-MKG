<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuController;
use App\Http\Controllers\PenyetujuController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use Livewire\Livewire;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\PDFController;

use App\Http\Livewire\PengajuanForm;
use App\Http\Livewire\InputPegawaiForm;
use App\Http\Livewire\PengaduanForm;
use App\Http\Livewire\PenyetujuDetail;
use App\Http\Livewire\PengajuanDetail;
use App\Http\Livewire\PegawaiDetail;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
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
    Route::get('/pengaju/pengajuan-detail/{idPengajuan}', PengajuanDetail::class)->name('pengaju.pengajuan-detail');
    Route::get('/pengaju/pengaduan-form', PengaduanForm::class)->name('pengaju.pengaduan.form');
});
// Penyetuju
Route::middleware(['auth', 'penyetujuMiddleware'])->group(function () {
    Route::get('/penyetuju', [PenyetujuController::class, 'daftarCuti'])->name('penyetuju.daftar-cuti');
    Route::get('/penyetuju/penyetuju-detail/{idPengajuan}', PenyetujuDetail::class)->name('penyetuju.penyetuju-detail');
    Route::get('/penyetuju/pengaduan-form', PengaduanForm::class)->name('penyetuju.pengaduan.form');
    Route::get('/penyetuju-dashboard', [PenyetujuController::class, 'dashboard'])->name('penyetuju.penyetuju-dashboard');
});
// Admin
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin', [AdminController::class, 'menuPengaduan'])->name('admin.menu-pengaduan');
    Route::get('/daftar-pegawai', [AdminController::class, 'daftarPegawai'])->name('admin.daftar-pegawai');
    Route::get('/input-pegawai', InputPegawaiForm::class)->name('admin.input-pegawai');
    Route::get('/detail-pegawai', PegawaiDetail::class)->name('admin.detail-pegawai');
});
//Cetak PDF
Route::get('/export-pdf/{id}', [PDFController::class, 'exportPDF']);
