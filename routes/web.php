<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajuController;
use App\Http\Controllers\PenyetujuController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\DaftarPengaduan;
use Illuminate\Support\Facades\Route;
use App\Http\Mail\PengajuanDisetujuiMail;
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
use App\Http\Livewire\RiwayatPengaduan;



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
    Route::get('/pengaju/riwayat-pengaduan', RiwayatPengaduan::class)->name('pengaju.riwayat-pengaduan');
    Route::get('/pengaju/pengaduan-form', PengaduanForm::class)->name('pengaju.pengaduan.form');
    Route::get('/exportPdf/{idPengajuan}', [PDFController::class, 'exportPDF']);
    // Route::get('/index/{idPengajuan}', [PDFController::class, 'index'])->name('pengaju.export-pdf');
});

// Penyetuju
Route::middleware(['auth', 'penyetujuMiddleware'])->group(function () {
    Route::get('/penyetuju', [PenyetujuController::class, 'daftarCuti'])->name('penyetuju.daftar-cuti');
    Route::get('/penyetuju/search-cuti', [PenyetujuController::class, 'searchCuti'])->name('penyetuju.search-cuti');
    Route::get('/penyetuju/penyetuju-detail/{idPengajuan}', PenyetujuDetail::class)->name('penyetuju.penyetuju-detail');
    Route::get('/penyetuju/riwayat-pengaduan', RiwayatPengaduan::class)->name('penyetuju.riwayat-pengaduan');
    Route::get('/penyetuju/pengaduan-form', PengaduanForm::class)->name('penyetuju.pengaduan.form');
    Route::get('/penyetuju-dashboard', [PenyetujuController::class, 'dashboard'])->name('penyetuju.penyetuju-dashboard');
});

// Admin
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin', DaftarPengaduan::class)->name('admin.daftar-pengaduan');
    Route::get('/daftar-pegawai', [AdminController::class, 'daftarPegawai'])->name('admin.daftar-pegawai');
    Route::get('/input-pegawai', InputPegawaiForm::class)->name('admin.input-pegawai');
    Route::get('/pegawai/{pegawaiId}', PegawaiDetail::class)->name('admin.detail-pegawai');
    Route::get('/admin/search-pegawai', [AdminController::class, 'searchPegawai'])->name('admin.search-pegawai');
});

Route::get('/pengajuan-cuti-email', function () {
    return view('emails.pengajuan-cuti');
})->name('pengajuan.cuti.email');
Route::get('/pengajuan-cuti-setuju-email', function () {
    return view('emails.penyetuju-setuju');
})->name('pengajuan.cuti.setuju.email');
Route::get('/pengajuan-cuti-tolak-email', function () {
    return view('emails.penyetuju-tolak');
})->name('pengajuan.cuti.tolak.email');

Route::get('/storage/public/{filename}', function ($filename) {
    $path = storage_path('app/public/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    abort(404);
})->where('filename', '.*')->name('preview');
