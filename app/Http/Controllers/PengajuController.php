<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatCuti;
use Illuminate\Support\Facades\Auth;

class PengajuController extends Controller
{
    public function index()
    {
        return view('pengaju.dashboard');
    }

    public function riwayatCuti()
    {
        $riwayatCuti = RiwayatCuti::getByPegawaiId(Auth::user()->pegawai_id);
        return view('pengaju.riwayat', compact('riwayatCuti'));
    }
}
