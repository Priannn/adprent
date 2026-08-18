@extends('layout.app')
@section('content')
   <div class="p-5">
     <div class="flex justify-between items-center">
        <h1 class="text-2xl font-semibold ">Data Mobil</h1>
        <a href="{{ route('mobil.create') }}" class="bg-[#162456] text-sm text-white py-2 px-4 rounded-lg font-semibold">
            TAMBAH MOBIL
        </a>
     </div>
     <table class="w-full border-collapse border border-slate-300 datatable">
    <thead>
        <tr>
            <th class="border border-slate-300 px-4 py-2">No</th>
            <th class="border border-slate-300 px-4 py-2">Nama Mobil</th>
            <th class="border border-slate-300 px-4 py-2">Merk Mobil</th>
            <th class="border border-slate-300 px-4 py-2">Gambar</th>
            <th class="border border-slate-300 px-4 py-2">Bahan Bakar</th>
            <th class="border border-slate-300 px-4 py-2">Transmisi</th>
            <th class="border border-slate-300 px-4 py-2">Harga Sewa</th>
            <th class="border border-slate-300 px-4 py-2">Jumlah Seat</th>
            <th class="border border-slate-300 px-4 py-2">Status</th>
            <th class="border border-slate-300 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($mobil as $index => $item)
        <tr>
            <td class="border border-slate-300 px-4 py-2">{{ $index + 1 }}</td>
            <td class="border border-slate-300 px-4 py-2">{{ $item->nama_mobil }}</td>
            <td class="border border-slate-300 px-4 py-2">{{ $item->merk }}</td>
           <td class="border border-slate-300 px-4 py-2">
                <img
                    src="{{ asset('storage/' . $item->gambar) }}"
                    alt="{{ $item->nama_mobil }}"
                    class="w-24 h-16 object-cover rounded-lg"
                >
            </td>
            <td class="border border-slate-300 px-4 py-2">{{ $item->bahan_bakar }}</td>
            <td class="border border-slate-300 px-4 py-2">{{ $item->transmisi }}</td>
            <td class="border border-slate-300 px-4 py-2">{{ $item->harga_sewa }}</td>
            <td class="border border-slate-300 px-4 py-2">{{ $item->jumlah_seat }}</td>
            <td class="border border-slate-300 px-4 py-2">{{ $item->status }}</td>
            <td class="border border-slate-300 px-4 py-2">
                <div class="flex gap-3">
                    <a href="{{ route('mobil.edit', $item->id) }}"
                    class="text-blue-500">
                        Edit
                    </a>

                    <button
                        type="button"
                        onclick="openDeleteModal({{ $item->id }}, '{{ $item->nama_mobil }}')"
                        class="text-red-500">
                        Hapus
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
      
    </tbody>
</table>
<div id="deleteModal"
    class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">

    <div class="bg-white rounded-xl p-6 w-full max-w-md">

        <h2 class="text-xl font-bold text-slate-800">
            Hapus Data Mobil?
        </h2>

        <p class="text-slate-600 mt-2">
            Apakah kamu yakin ingin menghapus data mobil <span class="font-bold" id="deleteNama"></span>?
        </p>

        <div class="flex justify-end gap-3 mt-6">

            <button
                type="button"
                onclick="closeDeleteModal()"
                class="px-4 py-2 rounded-lg bg-slate-200">
                Batal
            </button>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="px-4 py-2 rounded-lg bg-red-500 text-white">
                    Hapus
                </button>
            </form>

        </div>

    </div>

</div>
<script>
    function openDeleteModal(id, nama) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const deleteNama = document.getElementById('deleteNama');

        form.action = `/mobil/${id}`;
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