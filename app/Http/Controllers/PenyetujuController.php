<?php

namespace App\Http\Controllers;

use App\Models\ProsesCuti;
use Illuminate\Http\Request;

class PenyetujuController extends Controller
{
    public function index()
    {
        return view('penyetuju.daftar-cuti');
    }

    public function daftarCuti()
    {
        $listPengajuan = ProsesCuti::paginate(4);
        return view('penyetuju.daftar-cuti', compact('listPengajuan'));
    }
}
