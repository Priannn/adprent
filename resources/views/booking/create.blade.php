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
    @if ($errors->any())
    <div class="alert alert-danger" style="background: red; color: white; padding: 10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="max-w-5xl mx-auto px-5 py-10">

    <h1 class="text-3xl font-bold text-[#003049]">
        Booking Mobil
    </h1>

    <p class="text-gray-500 mt-2">
        Lengkapi data perjalanan Anda untuk melakukan booking.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

        {{-- INFORMASI MOBIL --}}
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">

            <div class="h-64 overflow-hidden">
                <img
                    src="{{ asset('storage/' . $mobil->gambar) }}"
                    alt="{{ $mobil->nama_mobil }}"
                    class="w-full h-full object-cover"
                >
            </div>

            <div class="p-6">

                <h2 class="text-2xl font-bold text-[#003049]">
                    {{ $mobil->nama_mobil }}
                </h2>

                <p class="text-gray-500 mt-1">
                    {{ $mobil->merk }}
                </p>

                <div class="grid grid-cols-3 gap-3 mt-5">

                    <div class="bg-gray-100 rounded-lg p-3 text-center">
                        <p class="text-xs text-gray-500">
                            Transmisi
                        </p>
                        <p class="font-semibold mt-1">
                            {{ ucfirst($mobil->transmisi) }}
                        </p>
                    </div>

                    <div class="bg-gray-100 rounded-lg p-3 text-center">
                        <p class="text-xs text-gray-500">
                            Seat
                        </p>
                        <p class="font-semibold mt-1">
                            {{ $mobil->jumlah_seat }}
                        </p>
                    </div>

                    <div class="bg-gray-100 rounded-lg p-3 text-center">
                        <p class="text-xs text-gray-500">
                            Bahan Bakar
                        </p>
                        <p class="font-semibold mt-1">
                            {{ ucfirst($mobil->bahan_bakar) }}
                        </p>
                    </div>

                </div>

                <div class="mt-6 pt-5 border-t">

                    <p class="text-sm text-gray-500">
                        Harga sewa
                    </p>

                    <p class="text-2xl font-bold text-[#D62828]">
                        Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}
                        <span class="text-sm text-gray-500 font-normal">
                            / hari
                        </span>
                    </p>

                </div>

            </div>

        </div>


        {{-- FORM BOOKING --}}
        <div class="bg-white rounded-2xl shadow-md p-6">

            <h2 class="text-xl font-bold text-[#003049]">
                Detail Booking
            </h2>

            <form
                action="{{ route('booking.store') }}"
                method="POST"
                class="mt-6"
            >
            @if($errors->any())
    <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-5">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                @csrf

                {{-- ID MOBIL --}}
                <input
                    type="hidden"
                    name="mobil_id"
                    value="{{ $mobil->id }}"
                >

                <div class="flex flex-col">

                    <label
                        for="tanggal_sewa"
                        class="text-sm font-medium text-gray-700"
                    >
                        Tanggal Sewa
                    </label>

                    <input
                        type="date"
                        id="tanggal_sewa"
                        name="tanggal_sewa"
                        value="{{ old('tanggal_sewa') }}"
                        min="{{ date('Y-m-d') }}"
                        class="mt-2 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#003049]"
                    >

                    @error('tanggal_sewa')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="flex flex-col mt-5">

                    <label
                        for="tanggal_kembali"
                        class="text-sm font-medium text-gray-700"
                    >
                        Tanggal Kembali
                    </label>

                    <input
                        type="date"
                        id="tanggal_kembali"
                        name="tanggal_kembali"
                        value="{{ old('tanggal_kembali') }}"
                        class="mt-2 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#003049]"
                    >

                    @error('tanggal_kembali')
                        <p class="text-red-500 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="mt-6 bg-gray-50 rounded-xl p-4">

                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Harga / hari
                        </span>

                        <span class="font-semibold">
                            Rp {{ number_format($mobil->harga_sewa, 0, ',', '.') }}
                        </span>

                    </div>

                    <div class="flex justify-between mt-2">

                        <span class="text-gray-500" id="durasi-text">
                            Durasi
                        </span>

                        <span class="font-semibold">
                            -
                        </span>

                    </div>

                    <div class="border-t mt-4 pt-4 flex justify-between">

                        <span class="font-bold">
                            Total
                        </span>

                        <span class="font-bold text-[#D62828]" id="total-text">
                            Rp 0
                        </span>

                    </div>

                </div>


                <button
                    type="submit"
                    class="w-full mt-6 bg-[#003049] text-white py-3 rounded-xl font-semibold hover:bg-[#00263a] transition"
                >
                    Booking Sekarang
                </button>

            </form>

        </div>

    </div>

</div>
<script>
    const inputSewa = document.getElementById('tanggal_sewa');
    const inputKembali = document.getElementById('tanggal_kembali');
    const durasiText = document.getElementById('durasi-text');
    const totalText = document.getElementById('total-text');
    const today = new Date().toISOString().split('T')[0];
    inputSewa.setAttribute('min', today);
    inputKembali.setAttribute('min', today);
    
    const hargaSewa = {{ $mobil->harga_sewa }};

    function hitungTotal() {
        const tglSewa = new Date(inputSewa.value);
        const tglKembali = new Date(inputKembali.value);

        if (inputSewa.value && inputKembali.value) {
            if (tglKembali >= tglSewa) {
                const diffTime = Math.abs(tglKembali - tglSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const durasiFinal = diffDays === 0 ? 1 : diffDays;
                
                durasiText.innerText = durasiFinal + ' Hari';
                const total = durasiFinal * hargaSewa;
                totalText.innerText = 'Rp ' + total.toLocaleString('id-ID');
            } else {
                durasiText.innerText = 'Tanggal Kembali Salah';
                totalText.innerText = 'Rp 0';
            }
        }
    }

    inputSewa.addEventListener('change', function() {
        inputKembali.setAttribute('min', inputSewa.value);
        if (inputKembali.value && inputKembali.value < inputSewa.value) {
            inputKembali.value = inputSewa.value;
        }
        hitungTotal();
    });

    inputKembali.addEventListener('change', hitungTotal);
</script>
</body>
</html>


