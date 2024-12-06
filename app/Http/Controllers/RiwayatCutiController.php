<?php

namespace App\Http\Controllers;

use App\Models\RiwayatCuti;
use App\Http\Requests\StoreRiwayatCutiRequest;
use App\Http\Requests\UpdateRiwayatCutiRequest;

class RiwayatCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $riwayatCuti = RiwayatCuti::all(); 
        // return view('riwayat', compact('riwayatCuti')); 
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRiwayatCutiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RiwayatCuti $riwayatCuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiwayatCuti $riwayatCuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiwayatCutiRequest $request, RiwayatCuti $riwayatCuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiwayatCuti $riwayatCuti)
    {
        //
    }
}
