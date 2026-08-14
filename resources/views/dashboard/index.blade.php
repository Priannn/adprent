@extends('layout.app')
@section('content')
<div class="grid grid-cols-4 p-5 gap-5">
    <div class="bg-[#0f172b] p-5 rounded-xl">
        <h1 class=" text-white">Total Mobil AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white">{{ $totalMobil }}</h1>
    </div>
    <div class="bg-[#0f172b] p-5 rounded-xl">
        <h1 class=" text-white">Total Pelanggan AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white">{{ $totalPelanggan }}</h1>
    </div>
    <div class="bg-[#0f172b] p-5 rounded-xl">
        <h1 class=" text-white">Total Penyewaan AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white">{{ $totalPenyewaan }}</h1>
    </div>
    <div class="bg-[#0f172b] p-5 rounded-xl">
        <h1 class=" text-white">Total Pendapatan AdpRent</h1>
        <h1 class="text-[28px] font-bold text-white">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h1>
    </div>
</div>
<div class="grid grid-cols-12 mx-5 gap-5">
    <div class="col-span-9">
        <div>
            <h2 class="text-2xl font-bold text-[#162456] mb-2">Penyewa Terbaru</h2>
            <table class="w-full border-collapse border border-slate-300">
                <thead>
                    <tr>
                        <th class="border border-slate-300 px-4 py-2">No</th>
                        <th class="border border-slate-300 px-4 py-2">Nama Penyewa</th>
                        <th class="border border-slate-300 px-4 py-2">Mobil disewa</th>
                        <th class="border border-slate-300 px-4 py-2">Tanggal Sewa</th>
                        <th class="border border-slate-300 px-4 py-2"> Tanggal Kembali</th>
                        <th class="border border-slate-300 px-4 py-2">Harga Sewa</th>
                        <th class="border border-slate-300 px-4 py-2">Status</th>
                    </tr>
                </thead>

                <tbody>
                     @foreach ($penyewaanTerbaru as $index => $item)
                <tr>
                    <td class="border border-slate-300 px-4 py-2">
                        {{ $index+1 }}
                    </td>
                    <td class="border border-slate-300 px-4 py-2">
                        {{ $item->pelanggan->nama_pelanggan }}
                    </td>

                    <td class="border border-slate-300 px-4 py-2">
                       {{ $item->mobil->nama_mobil }}
                    </td>

                    <td class="border border-slate-300 px-4 py-2">
                        {{ $item->tanggal_sewa }}
                    </td>

                    <td class="border border-slate-300 px-4 py-2">
                       {{ $item->tanggal_kembali }}
                    </td>
                    <td class="border border-slate-300 px-4 py-2">
                       Rp.{{ number_format($item->total_harga, 0, ',', '.') }}
                    </td>
                    <td class="border border-slate-300 px-4 py-2">
                       @if ($item->status == 'disewa')
                            <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700">
                                Disewa
                            </span>
                        @else
                            <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">
                                Selesai
                            </span>
                        @endif
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-span-3">
        <div class="flex flex-col justify-between h-full">
            <div class="p-5 bg-[#0f172b] text-white rounded-xl">
                <h1>Mobil Tersedia</h1>
                <p class="font-bold text-[28px]">{{ $mobilTersedia }}</p>
            </div>
            <div class="p-5 bg-[#0f172b] text-white rounded-xl">
                <h1>Mobil Disewa</h1>
                <p class="font-bold text-[28px]">{{ $mobilDisewa }}</p>
            </div>
        </div>
    </div>
</div>
@endsection