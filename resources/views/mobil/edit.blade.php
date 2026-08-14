@extends('layout.app')

@section('content')

<div class="p-5">
    <form action="{{ route('mobil.update', $mobil->id) }}" method="POST">
        @csrf
        @method('PUT')
        <main class="p-2 bg-slate-50">
            <h1 class="text-2xl font-bold mb-5 text-[#162456]">
                Edit Data Mobil
            </h1>
            <div class="grid grid-cols-2 gap-5">
                <div class="flex flex-col">
                    <label for="nama_mobil" class="text-sm text-slate-700">Nama Mobil</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="nama_mobil" name="nama_mobil" type="text" placeholder="masukan nama mobil" value="{{ old('nama_mobil', $mobil->nama_mobil) }}">
                    @error('nama_mobil')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="merk" class="text-sm text-slate-700">Merk Mobil</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="merk" name="merk" type="text" placeholder="masukan merk mobil" value="{{ old('merk', $mobil->merk) }}">
                    @error('merk')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="plat_nomor" class="text-sm text-slate-700">Plat Nomor</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="plat_nomor" name="plat_nomor" type="text" placeholder="masukan plat nomor mobil" value="{{ old('plat_nomor', $mobil->plat_nomor) }}">
                    @error('plat_nomor')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="tahun_mobil" class="text-sm text-slate-700">Tahun Mobil</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="tahun_mobil" name="tahun_mobil" type="number" placeholder="masukan tahun mobil" value="{{ old('tahun_mobil', $mobil->tahun_mobil) }}">
                    @error('tahun_mobil')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="harga_sewa" class="text-sm text-slate-700">Harga Sewa</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="harga_sewa" name="harga_sewa" type="number" placeholder="masukan harga sewa mobil" value="{{ old('harga_sewa', $mobil->harga_sewa) }}">
                    @error('harga_sewa')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
           
            </div>
        </main>
        <button type="submit" class="bg-[#162456] text-sm flex ml-auto text-white py-2 px-4 rounded-lg mt-5 font-semibold">
            Edit Data
        </button>

    </form>

</div>

@endsection