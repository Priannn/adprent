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
        $penyewaan = Penyewaan::with(['pelanggan','mobil'])->latest()->get();
        return view('penyewaan.index',compact('penyewaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        $mobil = Mobil::all();
        return view('penyewaan.create',compact('pelanggan','mobil'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // 1. Validasi input dari form (total_harga dihapus dari validasi)
    $request->validate([
        'pelanggan_id' => 'required',
        'mobil_id' => 'required',
        'tanggal_sewa' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa', // Sesuaikan jika izinkan 1 hari
    ]);

    // 2. Cek apakah mobil sudah dibooking pada tanggal yang bentrok
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
                'mobil_id' => 'Mobil tersebut sudah dipesan pada tanggal yang kamu pilih.'
            ]);
    }

    // 3. Ambil data mobil untuk tahu harga sewa per harinya
    $mobil = Mobil::findOrFail($request->mobil_id);

    // 4. Hitung durasi hari secara otomatis
    $tanggal_sewa = Carbon::parse($request->tanggal_sewa);
    $tanggal_kembali = Carbon::parse($request->tanggal_kembali);
    
    $jumlahHari = $tanggal_sewa->diffInDays($tanggal_kembali);
    $jumlahHari = max($jumlahHari, 1); // Minimal 1 hari jika tanggal sama

    // 5. Hitung total harga otomatis
    $total_harga = $mobil->harga_sewa * $jumlahHari;

    // 6. Simpan ke database
    Penyewaan::create([
        'pelanggan_id' => $request->pelanggan_id,
        'mobil_id' => $request->mobil_id,
        'tanggal_sewa' => $request->tanggal_sewa,
        'tanggal_kembali' => $request->tanggal_kembali,
        'total_harga' => $total_harga,
        'status' => 'menunggu', // Atau bisa langsung 'dikonfirmasi' jika admin yang input manual dari WA
    ]);

    return redirect()
        ->route('penyewaan.index')
        ->with('success', 'Penyewaan manual berhasil ditambahkan.');
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
   public function konfirmasi(Penyewaan $penyewaan)
{
    $bentrok = Penyewaan::where('mobil_id', $penyewaan->mobil_id)
        ->where('id', '!=', $penyewaan->id)
        ->whereIn('status', ['dikonfirmasi', 'disewa'])
        ->where(function ($query) use ($penyewaan) {

            $query->where('tanggal_sewa', '<=', $penyewaan->tanggal_kembali)
                  ->where('tanggal_kembali', '>=', $penyewaan->tanggal_sewa);

        })
        ->exists();

    if ($bentrok) {

        return back()->withErrors([
            'booking' => 'Booking tidak dapat dikonfirmasi karena mobil sudah memiliki booking lain pada tanggal tersebut.'
        ]);

    }

    $penyewaan->update([
        'status' => 'dikonfirmasi',
    ]);

    return redirect()
        ->route('penyewaan.index')
        ->with('success', 'Booking berhasil dikonfirmasi.');
}
    public function batalkan(Penyewaan $penyewaan)
{
    $penyewaan->update([
        'status' => 'dibatalkan',
    ]);

    return redirect()
        ->route('penyewaan.index')
        ->with('success', 'Booking berhasil dibatalkan.');
}

    public function availability(Request $request)
{
    $request->validate([
        'tanggal_sewa' => 'required|date',
        'tanggal_kembali' => 'required|date|after:tanggal_sewa',
    ]);

    $mobilTerbooking = Penyewaan::whereIn('status', [
            'menunggu',
            'dikonfirmasi',
            'disewa'
        ])
        ->where(function ($query) use ($request) {
            $query->where(
                'tanggal_sewa',
                '<=',
                $request->tanggal_kembali
            )->where(
                'tanggal_kembali',
                '>=',
                $request->tanggal_sewa
            );
        })
        ->pluck('mobil_id');

    $mobil = Mobil::whereNotIn('id', $mobilTerbooking)
        ->where('status', 'tersedia')
        ->get();

    return response()->json($mobil);
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
