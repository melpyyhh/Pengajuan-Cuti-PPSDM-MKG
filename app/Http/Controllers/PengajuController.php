<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuController extends Controller
{
    public function index()
    {
        return view('pengaju.dashboard');
    }
}
