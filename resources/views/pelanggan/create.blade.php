@extends('layout.app')

@section('content')

<div class="p-5">
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <main class="p-2 bg-slate-50">
            <h1 class="text-2xl font-bold mb-5 text-[#162456]">
                Tambah Pelanggan
            </h1>
            <div class="grid grid-cols-2 gap-5">
                <div class="flex flex-col">
                    <label for="nama_pelanggan" class="text-sm text-slate-700">Nama Pelanggan</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="nama_pelanggan" name="nama_pelanggan" type="text" placeholder="masukan nama pelanggan" value="{{ old('nama_pelanggan')}}">
                     @error('nama_pelanggan')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                    
                </div>
                <div class="flex flex-col">
                    <label for="nik" class="text-sm text-slate-700">NIK</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="nik" name="nik" type="number" placeholder="masukan nik" value="{{ old('nik') }}">
                    @error('nik')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="flex flex-col">
                    <label for="nomor_hp" class="text-sm text-slate-700">Nomor Handphone</label>
                    <input class="p-2 rounded-lg border border-blue-950 mt-2" id="nomor_hp" name="nomor_hp" type="number" placeholder="masukan nomor handphone" value="{{ old('nomor_hp') }}">
                     @error('nomor_hp')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                   
                </div>
                <div class="flex flex-col">
                    <label for="alamat" class="text-sm text-slate-700">Alamat</label>
                    <textarea class="p-2 rounded-lg border border-blue-950 mt-2" id="alamat" name="alamat" placeholder="masukan alamat rumahmu">{{ old('alamat') }}</textarea>
                </div>
                 @error('alamat')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
            </div>
        </main>
        <button type="submit" class="bg-[#162456] text-sm flex ml-auto text-white py-2 px-4 rounded-lg mt-5 font-semibold">
            TAMBAH
        </button>

    </form>

</div>

@endsection