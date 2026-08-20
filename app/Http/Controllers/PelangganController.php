<?php

namespace App\Http\Controllers;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
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
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit',compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'nama_pelanggan'=>'required',
            'nik'=>'required|numeric|unique:pelanggans,nik,' . $pelanggan->id,
            'nomor_hp'=>'required|numeric',
            'alamat'=>'required'
        ]);
        $pelanggan->update([
            'nama_pelanggan'=>$request->nama_pelanggan,
            'nik'=>$request->nik,
            'nomor_hp'=>$request->nomor_hp,
            'alamat'=>$request->alamat,
        ]);
        return redirect()->route('pelanggan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Pelanggan $pelanggan)
{
    $pelanggan->delete();
    return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
}
}
