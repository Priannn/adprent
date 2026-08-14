<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalMobil = Mobil::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::sum('total_harga');
        $penyewaanTerbaru = Penyewaan::latest()->take(3)->get();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilDisewa = Mobil::where('status', 'disewa')->count();
        return view('dashboard.index', compact(
        'totalMobil',
        'totalPelanggan',
        'totalPenyewaan',
        'totalPendapatan',
        'penyewaanTerbaru',
        'mobilTersedia',
        'mobilDisewa'
    ));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
