<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobil = Mobil::all();
        return view('mobil.index', compact('mobil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mobil'=>'required',
            'merk'=>'required',
            'plat_nomor'=>'required|unique:mobils,plat_nomor',
            'tahun_mobil'=>'required|numeric',
            'harga_sewa'=>'required|numeric',
            'status'=>'tersedia',
        ]);
        Mobil::create([
            'nama_mobil'=>$request->nama_mobil,
            'merk'=>$request->merk,
            'plat_nomor'=>$request->plat_nomor,
            'tahun_mobil'=>$request->tahun_mobil,
            'harga_sewa'=>$request->harga_sewa,
           
        ]);
        return redirect()->route('mobil.index');
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
    public function edit(Mobil $mobil)
    {
        return view('mobil.edit', compact('mobil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mobil $mobil)
    {
        $request->validate([
            'nama_mobil'=>'required',
            'merk'=>'required',
            'plat_nomor'=>'required|unique:mobils,plat_nomor,'.$mobil->id,
            'tahun_mobil'=>'required|numeric',
            'harga_sewa'=>'required|numeric',
           
        ]);
        $mobil->update([
            'nama_mobil'=>$request->nama_mobil,
            'merk'=>$request->merk,
            'plat_nomor'=>$request->plat_nomor,
            'tahun_mobil'=>$request->tahun_mobil,
            'harga_sewa'=>$request->harga_sewa,
           
        ]);
        return redirect()->route('mobil.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
        $mobil->delete();
        return redirect()->route('mobil.index');
    }
}
