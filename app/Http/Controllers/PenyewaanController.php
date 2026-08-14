<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Penyewaan;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaan = Penyewaan::with(['pelanggan','mobil'])->get();
        return view('penyewaan.index',compact('penyewaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $mobil = Mobil::where('status','tersedia')->get();
        return view('penyewaan.create',compact('pelanggan','mobil'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id'=>'required',
            'mobil_id'=>'required',
            'tanggal_sewa'=>'required|date',
            'tanggal_kembali'=>'required|date|after:tanggal_sewa',
            // 'status'=>'required|in:disewa,selesai',
        ]);
        $mobil = Mobil::findorFail($request->mobil_id);
        $tanggal_sewa = Carbon::parse($request->tanggal_sewa);
        $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
        $jumlahHari = $tanggal_sewa->diffInDays($tanggal_kembali);
        $jumlahHari = max($jumlahHari, 1);
        $total_harga = $mobil->harga_sewa * $jumlahHari;
        $cekBentrok = Penyewaan::where('mobil_id', $request->mobil_id)
        ->where('status', 'disewa')
        ->where(function ($query) use ($request) {
            $query->where('tanggal_sewa', '<', $request->tanggal_kembali)
                ->where('tanggal_kembali', '>', $request->tanggal_sewa);
        })->exists();
        if ($cekBentrok) {
            return back()
                ->withInput()
                ->withErrors([
                    'mobil_id' => 'Mobil tersebut sedang disewa pada tanggal tersebut.'
                ]);
        }
        Penyewaan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'mobil_id' => $request->mobil_id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $total_harga,
            'status' => 'disewa'
        ]);

        $mobil->update([
            'status' => 'disewa'
        ]);

return redirect()->route('penyewaan.index');
    }
  public function selesai(Penyewaan $penyewaan)
{
    if ($penyewaan->tanggal_kembali > now()->toDateString()) {
        return back()->withErrors([
            'penyewaan' => 'Mobil belum bisa dikembalikan karena tanggal kembali belum tiba.'
        ]);
    }

    $penyewaan->update([
        'status' => 'selesai'
    ]);

    $penyewaan->mobil->update([
        'status' => 'tersedia'
    ]);

    return redirect()->route('penyewaan.index');
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
