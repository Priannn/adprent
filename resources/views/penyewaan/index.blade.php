@extends('layout.app')

@section('content')

<div class="p-5">

    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold">
            Data Penyewaan
        </h1>

        <a
            href="{{ route('penyewaan.create') }}"
            class="bg-[#162456] text-sm text-white py-2 px-4 rounded-lg font-semibold">
            Tambah Penyewaan
        </a>
    </div>

    <table class="w-full border-collapse border border-slate-300 datatable">

        <thead>
            <tr>
                <th class="border border-slate-300 px-4 py-2">No</th>
                <th class="border border-slate-300 px-4 py-2">Pelanggan</th>
                <th class="border border-slate-300 px-4 py-2">Mobil</th>
                <th class="border border-slate-300 px-4 py-2">Tanggal Sewa</th>
                <th class="border border-slate-300 px-4 py-2">Tanggal Kembali</th>
                <th class="border border-slate-300 px-4 py-2">Total Harga</th>
                <th class="border border-slate-300 px-4 py-2">Status</th>
                <th class="border border-slate-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @foreach ($penyewaan as $index => $item)
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
                       {{ $item->total_harga }}
                    </td>
                    <td class="border border-slate-300 px-4 py-2">
                       @if($item->status == 'disewa')
                       <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-700">
                            Disewa
                        </span>
                       @else
                       <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-700">
                            Selesai
                        </span>
                       @endif
                    </td>

                    <td class="border border-slate-300 px-4 py-2">
                      @if ($item->status === 'disewa' && $item->tanggal_kembali <= now()->toDateString())
                            <form action="{{ route('penyewaan.selesai', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="text-green-500">
                                    Kembalikan
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
        @endforeach

              


            <div
                id="deleteModal"
                class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">

                <div class="bg-white rounded-xl p-6 w-full max-w-md">

                    <h2 class="text-xl font-bold text-slate-800">
                        Hapus Data Pelanggan?
                    </h2>

                    <p class="text-slate-600 mt-2">
                        Apakah kamu yakin ingin menghapus data pelanggan
                        <span class="font-bold" id="deleteNama">
                        
                        </span>?
                    </p>

                    <div class="flex justify-end gap-3 mt-6">

                        <button
                            type="button"
                            onclick="closeDeleteModal()"
                            class="px-4 py-2 rounded-lg bg-slate-200">
                            Batal
                        </button>

                        <form
                            id="deleteForm"
                            method="POST">

                            {{-- @csrf
                            @method('DELETE') --}}

                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg bg-red-500 text-white">
                                Hapus
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </tbody>

    </table>

    <script>
        function openDeleteModal(id, nama) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const deleteNama = document.getElementById('deleteNama');

            form.action = `/pelanggan/${id}`;
            deleteNama.textContent = nama;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</div>

@endsection