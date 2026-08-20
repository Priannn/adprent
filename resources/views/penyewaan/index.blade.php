@extends('layout.app')

@section('content')

<div class="p-5">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-[#162456]">
                Data Penyewaan
            </h1>
            <p class="text-gray-500 mt-1">
                Kelola pemesanan mobil dari pelanggan.
            </p>
        </div>
        <a href="{{ route('penyewaan.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pesanan (WA)
        </a>
    </div>

    {{-- NOTIFIKASI SUCCESS --}}
    @if(session('success'))
        <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- NOTIFIKASI ERROR (Penting jika konfirmasi admin gagal karena bentrok) --}}
    @if($errors->any())
        <div class="mb-5 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-xl shadow-md p-4">
        <table class="w-full border-collapse border border-slate-200">
            <thead>
                <tr class="bg-slate-100 text-sm">
                    <th class="border px-4 py-3">No</th>
                    <th class="border px-4 py-3">Pelanggan</th>
                    <th class="border px-4 py-3">Mobil</th>
                    <th class="border px-4 py-3">Tanggal Sewa</th>
                    <th class="border px-4 py-3">Tanggal Kembali</th>
                    <th class="border px-4 py-3">Total</th>
                    <th class="border px-4 py-3">Status</th>
                    <th class="border px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($penyewaan as $index => $item)
                    <tr>
                        <td class="border px-4 py-3 text-center">
                            {{ $index + 1 }}
                        </td>
                        <td class="border px-4 py-3">
                            {{ $item->pelanggan->nama_pelanggan ?? '-' }}
                        </td>
                        <td class="border px-4 py-3 font-semibold">
                            {{ $item->mobil->nama_mobil ?? '-' }}
                        </td>
                        <td class="border px-4 py-3 text-center">
                            {{ $item->tanggal_sewa }}
                        </td>
                        <td class="border px-4 py-3 text-center">
                            {{ $item->tanggal_kembali }}
                        </td>
                        <td class="border px-4 py-3 font-semibold text-[#D62828]">
                            Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>

                        {{-- STATUS --}}
                        <td class="border px-4 py-3 text-center">
                            @if($item->status === 'menunggu')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Menunggu</span>
                            @elseif($item->status === 'dikonfirmasi')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Dikonfirmasi</span>
                            @elseif($item->status === 'disewa')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Disewa</span>
                            @elseif($item->status === 'selesai')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">Selesai</span>
                            @elseif($item->status === 'dibatalkan')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Dibatalkan</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="border px-4 py-3 text-center">
                            @if($item->status === 'menunggu')
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('penyewaan.konfirmasi', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                            Konfirmasi
                                        </button>
                                    </form>

                                    <form action="{{ route('penyewaan.batalkan', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                            Batalkan
                                        </button>
                                    </form>
                                </div>
                            
                            {{-- TAMBAHAN: Tombol Selesai jika mobil sedang disewa/dikonfirmasi --}}
                            @elseif($item->status === 'dikonfirmasi' || $item->status === 'disewa')
                                <form action="{{ route('penyewaan.selesai', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition">
                                        Selesai / Kembalikan
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs italic">
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="border px-4 py-10 text-center text-gray-500">
                            Belum ada data pemesanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection