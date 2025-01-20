<?php

namespace App\Http\Controllers;

use App\Models\ProsesCuti;
use App\Models\RiwayatCuti;
use Illuminate\Http\Request;

class PenyetujuController extends Controller
{
    public function index()
    {
        return view('penyetuju.daftar-cuti');
    }

    public function daftarCuti(Request $request)
    {
        $search = $request->get('search'); // Mengambil query pencarian dari input
        if ($search) {
            $listPengajuan = ProsesCuti::search($search) // Menggunakan scopeSearch
                ->paginate(5)
                ->appends(['search' => $search]); // Append search query to pagination links
        } else {
            // Otherwise, show all results paginated
            $listPengajuan = ProsesCuti::paginate(5);
        }
        // Mengembalikan partial view dengan data hasil pencarian
        return view('penyetuju.daftar-cuti', compact('listPengajuan', 'search'));
    }

    public function searchCuti(Request $request)
    {
        $search = $request->get('search'); // Mengambil query pencarian dari input
        // Pencarian menggunakan scopeSearch di model ProsesCuti
        $listPengajuan = ProsesCuti::search($search)->get();
        // Mengembalikan partial view dengan data hasil pencarian
        return view('penyetuju.search-cuti', compact('listPengajuan'));
    }

    public function dashboard()
    {
        return view('penyetuju.penyetuju-dashboard');
    }
}
