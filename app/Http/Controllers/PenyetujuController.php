<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenyetujuController extends Controller
{
    public function index()
    {
        return view('penyetuju.dashboard');
    }
}
