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

    </div>


    @if(session('success'))

        <div class="mb-5 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>

    @endif


    <div class="overflow-x-auto">

        <table class="w-full border-collapse border border-slate-300">

            <thead>

                <tr class="bg-slate-100">

                    <th class="border px-4 py-3">
                        No
                    </th>

                    <th class="border px-4 py-3">
                        Pelanggan
                    </th>

                    <th class="border px-4 py-3">
                        Mobil
                    </th>

                    <th class="border px-4 py-3">
                        Tanggal Sewa
                    </th>

                    <th class="border px-4 py-3">
                        Tanggal Kembali
                    </th>

                    <th class="border px-4 py-3">
                        Total
                    </th>

                    <th class="border px-4 py-3">
                        Status
                    </th>

                    <th class="border px-4 py-3">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($penyewaan as $index => $item)

                    <tr>

                        <td class="border px-4 py-3 text-center">
                            {{ $index + 1 }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $item->pelanggan->nama_pelanggan }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $item->mobil->nama_mobil }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $item->tanggal_sewa }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $item->tanggal_kembali }}
                        </td>

                        <td class="border px-4 py-3">
                            Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>


                        {{-- STATUS --}}

                        <td class="border px-4 py-3 text-center">

                            @if($item->status === 'menunggu')

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                    Menunggu
                                </span>

                            @elseif($item->status === 'dikonfirmasi')

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                    Dikonfirmasi
                                </span>

                            @elseif($item->status === 'disewa')

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    Disewa
                                </span>

                            @elseif($item->status === 'selesai')

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                    Selesai
                                </span>

                            @elseif($item->status === 'dibatalkan')

                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    Dibatalkan
                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}

                        <td class="border px-4 py-3">

                            @if($item->status === 'menunggu')

                                <div class="flex gap-2">

                                    <form
                                        action="{{ route('penyewaan.konfirmasi', $item->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="bg-green-500 text-white px-3 py-2 rounded-lg text-sm"
                                        >
                                            Konfirmasi
                                        </button>

                                    </form>


                                    <form
                                        action="{{ route('penyewaan.batalkan', $item->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm"
                                        >
                                            Batalkan
                                        </button>

                                    </form>

                                </div>

                            @else

                                <span class="text-gray-400 text-sm">
                                    Tidak ada aksi
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="8"
                            class="border px-4 py-10 text-center text-gray-500"
                        >
                            Belum ada pemesanan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection