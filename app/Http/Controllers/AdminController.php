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

    public function daftarPegawai(Request $request)
    {
        // Get the search query
        $search = $request->get('search');
    
        if ($search) {
            // If there is a search query, filter the results
            $listPegawai = Pegawai::where('nama', 'LIKE', "%{$search}%")
                ->orWhere('nip', 'LIKE', "%{$search}%")
                ->orWhere('jabatan', 'LIKE', "%{$search}%")
                ->orWhere('unitKerja', 'LIKE', "%{$search}%")
                ->paginate(4)
                ->appends(['search' => $search]); // Append search query to pagination links
        } else {
            // Otherwise, show all results paginated
            $listPegawai = Pegawai::paginate(4);
        }
    
        // Send data to the view
        return view('admin.daftar-pegawai', compact('listPegawai', 'search'));
    }
    


    public function searchPegawai(Request $request)
    {
        $search = $request->get('search'); // Mengambil query pencarian dari input
        $listPegawai = Pegawai::where('nama', 'LIKE', "%{$search}%")
            ->orWhere('nip', 'LIKE', "%{$search}%")
            ->orWhere('jabatan', 'LIKE', "%{$search}%")
            ->orWhere('unitKerja', 'LIKE', "%{$search}%")
            ->get();

        // Mengembalikan partial view dengan data hasil pencarian
        return view('admin.search-pegawai', compact('listPegawai'));
    }
}
