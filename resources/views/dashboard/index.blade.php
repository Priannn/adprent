@extends('layout.app')
@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 p-5 gap-5">
    <div class="bg-[#0f172b] p-5 rounded-xl shadow-md">
        <h1 class="text-slate-300 text-sm">Total Mobil AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white mt-1">{{ $totalMobil }}</h1>
    </div>
    <div class="bg-[#0f172b] p-5 rounded-xl shadow-md">
        <h1 class="text-slate-300 text-sm">Total Pelanggan AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white mt-1">{{ $totalPelanggan }}</h1>
    </div>
    <div class="bg-[#0f172b] p-5 rounded-xl shadow-md">
        <h1 class="text-slate-300 text-sm">Total Penyewaan AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white mt-1">{{ $totalPenyewaan }}</h1>
    </div>
    <div class="bg-[#0f172b] p-5 rounded-xl shadow-md">
        <h1 class="text-slate-300 text-sm">Total Pendapatan AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white mt-1">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h1>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-12 mx-5 gap-5">
    <!-- TABEL PENYEWAA TERBARU -->
    <div class="md:col-span-9 bg-white p-5 rounded-xl shadow-md border border-slate-200">
        <h2 class="text-xl font-bold text-[#162456] mb-4">Penyewa Terbaru</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-slate-200 text-sm">
                <thead>
                    <tr class="bg-slate-100 text-slate-700">
                        <th class="border border-slate-200 px-4 py-2.5 text-center">No</th>
                        <th class="border border-slate-200 px-4 py-2.5 text-left">Nama Penyewa</th>
                        <th class="border border-slate-200 px-4 py-2.5 text-left">Mobil Disewa</th>
                        <th class="border border-slate-200 px-4 py-2.5 text-center">Tanggal Sewa</th>
                        <th class="border border-slate-200 px-4 py-2.5 text-center">Tanggal Kembali</th>
                        <th class="border border-slate-200 px-4 py-2.5 text-left">Harga Sewa</th>
                        <th class="border border-slate-200 px-4 py-2.5 text-center">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($penyewaanTerbaru as $index => $item)
                        <tr>
                            <td class="border border-slate-200 px-4 py-2.5 text-center">
                                {{ $index + 1 }}
                            </td>
                            <td class="border border-slate-200 px-4 py-2.5">
                                {{ $item->pelanggan->nama_pelanggan ?? '-' }}
                            </td>
                            <td class="border border-slate-200 px-4 py-2.5 font-medium">
                                {{ $item->mobil->nama_mobil ?? '-' }}
                            </td>
                            <td class="border border-slate-200 px-4 py-2.5 text-center">
                                {{ $item->tanggal_sewa }}
                            </td>
                            <td class="border border-slate-200 px-4 py-2.5 text-center">
                                {{ $item->tanggal_kembali }}
                            </td>
                            <td class="border border-slate-200 px-4 py-2.5 font-semibold text-[#D62828]">
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="border border-slate-200 px-4 py-2.5 text-center">
                                @if($item->status === 'menunggu')
                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">Menunggu</span>
                                @elseif($item->status === 'dikonfirmasi')
                                    <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">Dikonfirmasi</span>
                                @elseif($item->status === 'disewa')
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">Disewa</span>
                                @elseif($item->status === 'selesai')
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">Selesai</span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">Dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border border-slate-200 px-4 py-6 text-center text-gray-500">
                                Belum ada data penyewaan terbaru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- KOTAK INFORMASI KANAN -->
    <div class="md:col-span-3 space-y-4">
        <div class="p-5 bg-[#0f172b] text-white rounded-xl shadow-md">
            <h1 class="text-slate-300 text-sm">Mobil Tersedia</h1>
            <p class="font-bold text-[28px] mt-1">{{ $mobilTersedia }}</p>
        </div>
        <div class="p-5 bg-[#0f172b] text-white rounded-xl shadow-md">
            <h1 class="text-slate-300 text-sm">Mobil Disewa</h1>
            <p class="font-bold text-[28px] mt-1">{{ $mobilDisewa }}</p>
        </div>
    </div>
</div>
@endsection