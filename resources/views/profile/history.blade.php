<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="max-w-6xl mx-auto px-5 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#003049]">
            Riwayat Pemesanan
        </h1>

        <p class="text-gray-500 mt-2">
            Lihat semua riwayat booking Anda.
        </p>
    </div>
    <div class="">
     <a href="{{ route('landing') }}" class="font-semibold text-[#DC143C]"> <- Kembali ke landingpage</a>
   </div>

    @if ($booking->count())

        <div class="space-y-5">

            @foreach ($booking as $item)

                <div class="bg-white rounded-2xl shadow-md p-5">

                    <div class="flex flex-col md:flex-row gap-5">

                        {{-- Gambar Mobil --}}
                        <div class="w-full md:w-48 h-32 overflow-hidden rounded-xl">

                            <img
                                src="{{ asset('storage/' . $item->mobil->gambar) }}"
                                alt="{{ $item->mobil->nama_mobil }}"
                                class="w-full h-full object-cover"
                            >

                        </div>

                        {{-- Informasi --}}
                        <div class="flex-1">

                            <div class="flex justify-between gap-4">

                                <div>
                                    <h2 class="text-xl font-bold text-[#003049]">
                                        {{ $item->mobil->nama_mobil }}
                                    </h2>

                                    <p class="text-gray-500 text-sm">
                                        {{ $item->mobil->merk }}
                                    </p>
                                </div>

                                <span class="h-fit px-3 py-1 rounded-full text-xs font-semibold
                                    @if($item->status === 'menunggu')
                                        bg-yellow-100 text-yellow-700
                                    @elseif($item->status === 'dikonfirmasi')
                                        bg-blue-100 text-blue-700
                                    @elseif($item->status === 'disewa')
                                        bg-green-100 text-green-700
                                    @elseif($item->status === 'selesai')
                                        bg-gray-100 text-gray-700
                                    @elseif($item->status === 'dibatalkan')
                                        bg-red-100 text-red-700
                                    @endif
                                ">
                                    {{ ucfirst($item->status) }}
                                </span>

                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-5">

                                <div>
                                    <p class="text-xs text-gray-500">
                                        Tanggal Sewa
                                    </p>

                                    <p class="text-sm font-semibold">
                                        {{ $item->tanggal_sewa }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500">
                                        Tanggal Kembali
                                    </p>

                                    <p class="text-sm font-semibold">
                                        {{ $item->tanggal_kembali }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs text-gray-500">
                                        Total
                                    </p>

                                    <p class="text-sm font-bold text-[#D62828]">
                                        Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-gray-50 rounded-2xl p-10 text-center">

            <h2 class="text-xl font-semibold text-gray-700">
                Belum ada pemesanan
            </h2>

            <p class="text-gray-500 mt-2">
                Yuk pilih mobil dan mulai perjalananmu di Bali.
            </p>

            <a
                href="{{ route('landing') }}#mobil"
                class="inline-block mt-5 bg-[#003049] text-white px-5 py-3 rounded-xl font-semibold"
            >
                Lihat Mobil
            </a>

        </div>

    @endif

</div>
</body>
</html>