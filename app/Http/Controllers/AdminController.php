<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function menuPengaduan()
    {
        
        return view('admin.menu-pengaduan', compact('pengaduans', 'totalPengaduan', 'daftartungguCount', 'ditanggapiCount'));
    }

    public function daftarPegawai()
    {
        // Menampilkan 4 pegawai per halaman
        $listPegawai = Pegawai::paginate(4);

        // Mengirimkan data ke view
        return view('admin.daftar-pegawai', compact('listPegawai'));
    }
}
