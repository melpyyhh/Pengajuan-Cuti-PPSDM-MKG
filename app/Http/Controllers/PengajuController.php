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
        // dd(auth()->user());
        $riwayatCuti = RiwayatCuti::all();
        // $riwayatCuti = RiwayatCuti::where('pegawai_id', Auth::user()->id); 
        // dd($riwayatCuti); 
        return view('pengaju.riwayat', compact('riwayatCuti'));
    }
}
