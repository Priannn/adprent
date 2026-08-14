@extends('layout.app')

@section('content')

<div class="p-5">

    <form action="{{ route('penyewaan.store') }}" method="POST">
        @csrf

        <main class="p-2 bg-slate-50">

            <h1 class="text-2xl font-bold mb-5 text-[#162456]">
                Tambah Penyewaan
            </h1>

            <div class="grid grid-cols-2 gap-5">

                {{-- Pelanggan --}}
                <div class="flex flex-col">
                    <label for="pelanggan_id" class="text-sm text-slate-700">
                        Pelanggan
                    </label>

                    <select
                        id="pelanggan_id"
                        name="pelanggan_id"
                        class="p-2 rounded-lg border border-blue-950 mt-2">

                        <option value="">Pilih Pelanggan</option>

                        @foreach ($pelanggan as $item)
                            <option
                                value="{{ $item->id }}"
                                {{ old('pelanggan_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_pelanggan }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Mobil --}}
                <div class="flex flex-col">
                    <label for="mobil_id" class="text-sm text-slate-700">
                        Mobil
                    </label>

                    <select
                        id="mobil_id"
                        name="mobil_id"
                        class="p-2 rounded-lg border border-blue-950 mt-2">

                        <option value="">Pilih Mobil</option>

                        @foreach ($mobil as $item)
                            <option
                                value="{{ $item->id }}"
                                {{ old('mobil_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_mobil }} - {{ $item->plat_nomor }}
                            </option>
                        @endforeach

                    </select>
                </div>

                {{-- Tanggal Sewa --}}
                <div class="flex flex-col">
                    <label for="tanggal_sewa" class="text-sm text-slate-700">
                        Tanggal Sewa
                    </label>

                    <input
                        id="tanggal_sewa"
                        name="tanggal_sewa"
                        type="date"
                        value="{{ old('tanggal_sewa') }}"
                        class="p-2 rounded-lg border border-blue-950 mt-2">
                </div>

                {{-- Tanggal Kembali --}}
                <div class="flex flex-col">
                    <label for="tanggal_kembali" class="text-sm text-slate-700">
                        Tanggal Kembali
                    </label>

                    <input
                        id="tanggal_kembali"
                        name="tanggal_kembali"
                        type="date"
                        value="{{ old('tanggal_kembali') }}"
                        class="p-2 rounded-lg border border-blue-950 mt-2">
                </div>

                {{-- Status --}}
                {{-- <div class="flex flex-col">
                    <label for="status" class="text-sm text-slate-700">
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="p-2 rounded-lg border border-blue-950 mt-2">

                        <option value="">Pilih Status</option>
                        <option value="disewa">Disewa</option>
                    </select>
                </div> --}}

            </div>

        </main>

        <button
            type="submit"
            class="bg-[#162456] text-sm flex ml-auto text-white py-2 px-4 rounded-lg mt-5 font-semibold">

            TAMBAH

        </button>

    </form>

</div>

@endsection