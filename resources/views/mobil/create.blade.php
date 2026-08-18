@extends('layout.app')

@section('content')

<div class="p-5">
    <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <main class="p-2 bg-slate-50">
            <h1 class="text-2xl font-bold mb-5 text-[#162456]">
                Tambah Data Mobil
            </h1>
            <div class="grid grid-cols-2 gap-5">
                <div class="flex flex-col">
                    <label for="nama_mobil" class="text-sm text-slate-700">Nama Mobil</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="nama_mobil" name="nama_mobil" type="text" placeholder="masukan nama mobil" value="{{ old('nama_mobil') }}">
                    @error('nama_mobil')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="merk" class="text-sm text-slate-700">Merk Mobil</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="merk" name="merk" type="text" placeholder="masukan merk mobil" value="{{ old('merk') }}">
                    @error('merk')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="gambar" class="text-sm text-slate-700">Gambar</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="gambar" name="gambar" type="file" placeholder="masukan gambar mobil" value="{{ old('gambar') }}">
                    @error('gambar')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="bahan_bakar" class="text-sm text-slate-700">Bahan Bakar</label>
                  <select name="bahan_bakar" class="p-2 rounded-lg border border-blue-950 mt-2">
                    <option value="bensin" {{ old('bahan_bakar') == 'bensin' ? 'selected' : '' }}>Matic</option>
                    <option value="diesel" {{  old('bahan_bakar') == 'diesel' ? 'selected' : '' }}>Manual</option>
                  </select>
                    @error('bahan_bakar')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="transmisi" class="text-sm text-slate-700">Transmisi</label>
                  <select name="transmisi" class="p-2 rounded-lg border border-blue-950 mt-2">
                    <option value="matic" {{ old('transminsi') == 'matic' ? 'selected' : '' }}>Matic</option>
                    <option value="manual" {{  old('transminsi') == 'manual' ? 'selected' : '' }}>Manual</option>
                  </select>
                    @error('transmisi')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="harga_sewa" class="text-sm text-slate-700">Harga Sewa</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="harga_sewa" name="harga_sewa" type="number" placeholder="masukan harga sewa mobil" value="{{ old('harga_sewa') }}">
                    @error('harga_sewa')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="jumlah_seat" class="text-sm text-slate-700">Jumlah Seat</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="jumlah_seat" name="jumlah_seat" type="number" placeholder="masukan harga sewa mobil" value="{{ old('jumlah_seat') }}">
                    @error('jumlah_seat')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
              
            </div>
        </main>
        <button type="submit" class="bg-[#162456] text-sm flex ml-auto text-white py-2 px-4 rounded-lg mt-5 font-semibold">
            TAMBAH
        </button>

    </form>

</div>

@endsection