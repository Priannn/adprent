<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'transmisi'=>'required|in:matic,manual',
            'harga_sewa'=>'required|numeric',
            'jumlah_seat'=>'required|numeric|min:1',
       
        ]);
        $gambar = $request->file('gambar')->store('mobil','public');
        Mobil::create([
            'nama_mobil'=>$request->nama_mobil,
            'merk'=>$request->merk,
            'gambar'=>$gambar,
            'transmisi'=>$request->transmisi,
            'jumlah_seat'=>$request->jumlah_seat,
            'harga_sewa'=>$request->harga_sewa,
            'status'=>'tersedia',
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
             'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'transmisi' => 'required|in:matic,manual',
            'harga_sewa'=>'required|numeric',
            'jumlah_seat'=>'required|numeric|min:1',
           
        ]);
        $data = [
        'nama_mobil' => $request->nama_mobil,
        'merk' => $request->merk,
        'transmisi' => $request->transmisi,
        'jumlah_seat' => $request->jumlah_seat,
        'harga_sewa' => $request->harga_sewa,
        ];

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($mobil->gambar) {
                Storage::disk('public')->delete($mobil->gambar);
            }

            // simpan gambar baru
            $data['gambar'] = $request->file('gambar')
                ->store('mobil', 'public');
        }
        $mobil->update($data);
        return redirect()->route('mobil.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {
         // Hapus gambar dari storage
        if ($mobil->gambar) {
            Storage::disk('public')->delete($mobil->gambar);
        }
        $mobil->delete();
        return redirect()->route('mobil.index');
    }
}
