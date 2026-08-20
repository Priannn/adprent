<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pelanggan;
use App\Models\Penyewaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create(Mobil $mobil){
        return view('booking.create', compact('mobil'));
    }

    public function store(Request $request){
    
        $request->validate([
            'mobil_id'=>'required|exists:mobils,id',
            'tanggal_sewa'=>'required|date|after_or_equal:today',
            // Perhatian: Di sini sebaiknya izinkan tanggal yang sama (gunakan after_or_equal jika di form mengizinkan 1 hari di tanggal yang sama)
            // Tapi sesuaikan dengan validasi form kamu sebelumnya.
            'tanggal_kembali'=>'required|date|after_or_equal:tanggal_sewa', 
        ]);

        $pelanggan = Pelanggan::where('user_id', Auth::id())->first();
        if(!$pelanggan){
            return back()->withErrors([
                'booking'=>'data pelanggan tidak ditemukan'
            ]);
        }

        // === TAMBAHKAN PENGECEKAN BENTROK DI SINI ===
        $bentrok = Penyewaan::where('mobil_id', $request->mobil_id)
            ->whereIn('status', ['menunggu', 'dikonfirmasi', 'disewa'])
            ->where(function ($query) use ($request) {
                $query->where('tanggal_sewa', '<=', $request->tanggal_kembali)
                      ->where('tanggal_kembali', '>=', $request->tanggal_sewa);
            })
            ->exists();

        if ($bentrok) {
            return back()
                ->withInput()
                ->withErrors([
                    'tanggal_sewa' => 'Maaf, mobil ini sudah dipesan atau dibooking pada tanggal tersebut.'
                ]);
        }
        // =============================================
       
        $mobil = Mobil::findOrFail($request->mobil_id);
        $tanggalSewa = Carbon::parse($request->tanggal_sewa); 
        $tanggalKembali = Carbon::parse($request->tanggal_kembali);
        $durasi = $tanggalSewa->diffInDays($tanggalKembali);
        $durasi = ($durasi == 0) ? 1 : $durasi;
        $totalHarga = $durasi * $mobil->harga_sewa;

        Penyewaan::create([
            'pelanggan_id' => $pelanggan->id,
            'mobil_id' => $mobil->id,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $totalHarga,
            'status' => 'menunggu',
        ]);

        return redirect()->route('landing')->with('success','booking berhasil dibuat!');
    }
}