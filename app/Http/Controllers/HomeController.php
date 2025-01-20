<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'pengaju') {
                return redirect()->route('pengaju.riwayat');
            } elseif (Auth::user()->role === 'penyetuju') {
                return redirect()->route('penyetuju.daftar-cuti');
            } elseif (Auth::user()->role === 'admin') {
                return redirect()->route('admin.daftar-pengaduan');
            } elseif (Auth::user()->role === 'dual_role') {
                return redirect()->route('pengaju.riwayat');
            }
        }
        return redirect()->route('login');
    }
}
