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

    public function daftarCuti()
    {
        $listPengajuan = ProsesCuti::paginate(5);
        return view('penyetuju.daftar-cuti', compact('listPengajuan'));
    }

    public function dashboard()
    {
        return view('penyetuju.penyetuju-dashboard');
    }
}
