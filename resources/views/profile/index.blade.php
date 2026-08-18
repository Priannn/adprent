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
<div class="max-w-4xl mx-auto px-5 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#003049]">
            Profil Saya
        </h1>

        <p class="text-gray-500 mt-2">
            Kelola informasi pribadi Anda.
        </p>
    </div>

   <div class="">
     <a href="{{ route('landing') }}" class="font-semibold text-[#DC143C]"> <- Kembali ke landingpage</a>
   </div>
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-gray-500">
                    Nama Lengkap
                </p>

                <p class="font-semibold text-gray-800 mt-1">
                    {{ $pelanggan->nama_pelanggan }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Email
                </p>

                <p class="font-semibold text-gray-800 mt-1">
                    {{ $pelanggan->user->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    NIK
                </p>

                <p class="font-semibold text-gray-800 mt-1">
                    {{ $pelanggan->nik }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">
                    Nomor HP
                </p>

                <p class="font-semibold text-gray-800 mt-1">
                    {{ $pelanggan->nomor_hp }}
                </p>
            </div>

            <div class="md:col-span-2">
                <p class="text-sm text-gray-500">
                    Alamat
                </p>

                <p class="font-semibold text-gray-800 mt-1">
                    {{ $pelanggan->alamat }}
                </p>
            </div>

        </div>

    </div>

</div>
</body>
</html>