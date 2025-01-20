<?php

namespace App\Http\Controllers;

use App\Models\ProsesCuti;
use App\Models\RiwayatCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyetujuController extends Controller
{
    public function index()
    {
        return view('penyetuju.daftar-cuti');
    }

    public function daftarCuti()
    {
        $userId = Auth::user()->id;
        $listPengajuan = ProsesCuti::whereHas('pengajuan', function ($query) use ($userId) {
            $query->where('penyetuju_id', $userId);
        })->paginate(5);
        return view('penyetuju.daftar-cuti', compact('listPengajuan'));
    }

    public function dashboard()
    {
        return view('penyetuju.penyetuju-dashboard');
    }
}
