<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@14.0.1/swiper-bundle.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="bg-[#FBFBFB]">
  
   <section class="max-w-5xl mx-auto p-6 relative">
    <div class="flex justify-between items-center">

        {{-- LOGO --}}
        <a href="{{ route('landing') }}">
            <img src="{{ asset('images/logo/logo.svg') }}" alt="Logo">
        </a>


        {{-- NAVBAR DESKTOP --}}
        <div class="hidden md:flex space-x-8">
            <a href="{{ route('landing') }}" class="cursor-pointer">Home</a>
            <a href="#tentang" class="cursor-pointer">Tentang Kami</a>
            <a href="#katalog" class="cursor-pointer">Katalog</a>
            <a href="#testimoni" class="cursor-pointer">Testimoni</a>
        </div>


        {{-- RIGHT DESKTOP --}}
        <div class="hidden md:block relative">

            @auth

                {{-- ADMIN --}}
                @if(Auth::user()->role === 'admin')

                    <a
                        href="{{ route('dashboard') }}"
                        class="bg-[#003049] rounded-full py-2 px-6 text-white font-bold"
                    >
                        Dashboard
                    </a>

                {{-- USER --}}
                @else

                    <button
                        id="profileButton"
                        type="button"
                        class="flex items-center gap-2 bg-[#003049] rounded-full py-2 px-5 text-white font-bold"
                    >

                        {{-- Avatar huruf pertama --}}
                        <div class="w-7 h-7 rounded-full bg-white text-[#003049] flex items-center justify-center text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <span>
                            {{ Auth::user()->name }}
                        </span>

                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m19 9-7 7-7-7"
                            />
                        </svg>

                    </button>


                    {{-- DROPDOWN --}}
                    <div
                        id="profileDropdown"
                        class="hidden absolute right-0 top-12 mt-2 w-64 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden z-50"
                    >

                        {{-- USER INFO --}}
                        <div class="px-5 py-4 border-b border-slate-100">

                            <p class="font-bold text-[#003049]">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-sm text-gray-500 truncate">
                                {{ Auth::user()->email }}
                            </p>

                        </div>


                        {{-- MENU --}}
                        <div class="py-2">

                            <a
                                href="{{ route('profile') }}"
                                class="block px-5 py-3 text-sm text-gray-700 hover:bg-slate-50"
                            >
                                Profil Saya
                            </a>

                            <a
                                href="{{ route('booking.history') }}"
                                class="block px-5 py-3 text-sm text-gray-700 hover:bg-slate-50"
                            >
                                Riwayat Pemesanan
                            </a>

                        </div>


                        {{-- LOGOUT --}}
                        <div class="border-t border-slate-100 py-2">

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                            >
                                @csrf

                                <button
                                    type="submit"
                                    class="w-full text-left px-5 py-3 text-sm text-red-500 hover:bg-red-50"
                                >
                                    Logout
                                </button>

                            </form>

                        </div>

                    </div>

                @endif

            @else

                {{-- BELUM LOGIN --}}
                <a
                    href="{{ route('login') }}"
                    class="inline-block bg-[#003049] rounded-full py-2 px-6 text-white font-bold"
                >
                    Login
                </a>

            @endauth

        </div>


        {{-- HAMBURGER --}}
        <button
            id="hamburger-btn"
            class="block md:hidden text-[#003049] focus:outline-none"
        >
            <svg
                class="w-8 h-8"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>
        </button>

    </div>


    {{-- MOBILE MENU --}}
    <div
        id="mobile-menu"
        class="hidden absolute top-20 left-6 right-6 bg-white shadow-xl rounded-xl p-6 flex-col space-y-4 z-50 md:hidden border border-slate-100"
    >

        <a
            href="{{ route('landing') }}"
            class="text-[#003049] font-medium border-b border-slate-100 pb-2"
        >
            Home
        </a>

        <a
            href="#tentang"
            class="text-[#003049] font-medium border-b border-slate-100 pb-2"
        >
            Tentang Kami
        </a>

        <a
            href="#katalog"
            class="text-[#003049] font-medium border-b border-slate-100 pb-2"
        >
            Katalog
        </a>

        <a
            href="#testimoni"
            class="text-[#003049] font-medium border-b border-slate-100 pb-2"
        >
            Testimoni
        </a>
        @auth
            @if(Auth::user()->role === 'admin')

                <a
                    href="{{ route('dashboard') }}"
                    class="bg-[#003049] rounded-full py-3 px-6 text-white font-bold text-center"
                >
                    Dashboard
                </a>
            @else

                <a
                    href="{{ route('profile') }}"
                    class="text-[#003049] font-medium border-b border-slate-100 pb-2"
                >
                    Profil Saya
                </a>

                <a
                    href="{{ route('booking.history') }}"
                    class="text-[#003049] font-medium border-b border-slate-100 pb-2"
                >
                    Riwayat Pemesanan
                </a>

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="w-full bg-red-500 rounded-full py-3 px-6 text-white font-bold text-center"
                    >
                        Logout
                    </button>

                </form>

            @endif

        @else

            <a
                href="{{ route('login') }}"
                class="block bg-[#003049] rounded-full py-3 px-6 text-white font-bold text-center"
            >
                Login
            </a>

        @endauth

    </div>

</section>
    <section class="overflow-hidden">
        <div class="text-center mt-10 md:mt-16">
            <h1 class="text-3xl md:text-4xl font-bold text-[#003049]" data-aos="fade-down">
                Sewa Mobil Untuk <br>
                Perjalanan Anda Berikutnya
            </h1>

            <p class="mt-3 px-5" data-aos="fade-down">
                Pilihan mobil nyaman dan terpercaya untuk menemani setiap perjalanan Anda di Bali.
            </p>

            <div class="overflow-hidden mt-8" data-aos="fade-down">
                <img
                    src="{{ asset('images/icon/hero.svg') }}"
                    alt="Adprent Bali"
                    class="
                        w-[150%]
                        sm:w-[800px]
                        md:w-full
                        max-w-none
                        relative
                        left-1/2
                        -translate-x-1/2
                    "
                >
            </div>
        </div>
    </section>
    <main class="mt-16 max-w-5xl mx-auto px-6">

        <section class="">
            <h1 class="text-[#D62828] font-bold text-[20px] text-center">Kenapa Adprent ?</h1>
            <h1 class="text-[#003049] font-bold text-[24px] text-center">Beda Rental, Beda Pengalaman</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 mt-10 gap-5">
                <div class="shadow-lg rounded-xl p-4" data-aos="fade-down">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#002f4950] rounded-xl p-3">
                            <img src="{{ asset('images/icon/cust24.svg') }}" class="w-10">
                        </div>
                        <div class="">
                            <h1 class="text-[#003049] font-bold text-[20px]">24/7 Support</h1>
                        </div>
                    </div>
                    <p class="mt-5 text-[14px]">Tim kami selalu tersedia untuk memberikan informasi dan membantu kebutuhan rental Anda selama 24 jam.</p>
                </div>
                <div class="shadow-lg rounded-xl p-4"  data-aos="fade-down">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#002f4950] rounded-xl p-3">
                            <img src="{{ asset('images/icon/cust24.svg') }}" class="w-10">
                        </div>
                        <div class="">
                            <h1 class="text-[#003049] font-bold text-[20px]">Mobil Terawat</h1>
                        </div>
                    </div>
                    <p class="mt-5 text-[14px]">Setiap kendaraan dirawat dan diperiksa secara berkala agar selalu dalam kondisi bersih, nyaman, dan siap digunakan.</p>
                </div>
                <div class="shadow-lg rounded-xl p-4"  data-aos="fade-down">
                    <div class="flex items-center space-x-3">
                        <div class="bg-[#002f4950] rounded-xl p-3">
                            <img src="{{ asset('images/icon/cust24.svg') }}" class="w-10">
                        </div>
                        <div class="">
                            <h1 class="text-[#003049] font-bold text-[20px]">Driver Handal</h1>
                        </div>
                    </div>
                    <p class="mt-5 text-[14px]">Driver kami memiliki pengalaman dan kualifikasi yang tinggi, sehingga Anda dapat berkendara dengan nyaman dan aman.</p>
                </div>
            </div>
        </section>

        <section class="mt-20 md:mt-28">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-5">
                <div class="flex flex-col justify-center order-2 md:order-1"  data-aos="fade-right">
                    <h1 class="font-bold text-[20px] md:text-[28px] text-[#003049]">Bukan sekedar sewa mobil, <br>Tapi teman di setiap <span class="text-[#D62828]">perjalanan</span></h1>
                    <p class="my-5 text-[15px] text-justify">Adprent Bali hadir untuk membuat perjalanan Anda di Bali menjadi lebih mudah, nyaman, dan bebas khawatir. Dengan kendaraan yang terawat, pelayanan yang responsif, serta driver profesional, kami siap menemani setiap perjalanan Anda.</p>
                    <p class="text-[15px] text-justify">Mau liburan, perjalanan bisnis, atau sekadar menjelajahi sudut-sudut Bali?Kami siapkan kendaraannya, Anda tinggal menikmati perjalanannya.</p>
                </div>
                <div class="order-1 md:order-2"  data-aos="fade-left">
                    <img src="{{ asset('images/icon/aboutus.png') }}" class="rounded-xl w-full">
                </div>
            </div>
        </section>

        <section class="mt-20 md:mt-28">
            <div class="">
                <h1 class="font-bold text-[24px] md:text-[28px] text-[#003049]">Pilih Mobilnya, <br>Tentukan Perjalanannya</h1>
                <p class="my-5 text-[15px] text-justify">Setiap perjalanan punya kebutuhan yang berbeda. Temukan <br class="hidden md:block"> pilihan kendaraan yang sesuai dengan gaya perjalanan dan <br class="hidden md:block">kebutuhan Anda.</p>
            </div>
           @foreach ($mobil as $item) 
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
                <div class="space-y-3 p-4 shadow-xl rounded-xl">
                    <img src="{{ asset('storage/' .$item->gambar) }}" class="w-full">
                    <h1 class="font-bold">{{ $item->merk }} {{ $item->nama_mobil }}</h1>
                    <h1 class="text-[#D62828] font-semibold text-xl">IDR {{ number_format($item->harga_sewa, 0, ',', '.') }}<span class="text-[10px] text-slate-500">/hari</span></h1>
                    <div class="flex items-center space-x-2">
                        <div class="flex">
                            <img src="{{ asset('images/icon/bahanbakar.svg') }}" alt="" class="w-3">
                            <h1 class="ml-2 text-sm text-slate-400">{{ $item->bahan_bakar }}</h1>
                        </div>
                        <div class="flex">
                            <img src="{{ asset('images/icon/transmisi.svg') }}" alt="" class="w-3">
                            <h1 class="ml-2 text-sm text-slate-400">{{ $item->transmisi }}</h1>
                        </div>
                        <div class="flex">
                            <img src="{{ asset('images/icon/seat.svg') }}" alt="" class="w-3">
                            <h1 class="ml-2 text-sm text-slate-400">{{ $item->jumlah_seat }}</h1>
                        </div>
                    </div>
                    <div class="flex gap-3 mt-4">
                        <button class="bg-[#003049] text-[9px] text-white py-2 px-3 rounded-full font-semibold flex-1"><a href="{{ route('booking.create', $item->id) }}">Book Sekarang</a></button>
                        <button class="text-[10px] border border-[#003049] text-[#003049] py-2 px-3 rounded-full font-semibold flex-1"><a href="https://wa.me/62895800183963">Chat Admin</a></button>
                    </div>
                </div>
            </div>
           @endforeach
        </section>

        @php
            $testimonials = [
                ['name' => 'Budi Pratama', 'text' => 'Sangat merekomendasikan ini untuk teman-teman. User interface-nya mudah dipahami.'],
                ['name' => 'Rina Melati', 'text' => 'Harga terjangkau dengan kualitas premium. Pasti akan berlangganan lagi.'],
                ['name' => 'Deni Darmawan', 'text' => 'Fiturnya lengkap dan sangat membantu produktivitas pekerjaan saya sehari-hari.'],
                ['name' => 'Siti Aminah', 'text' => 'Awalnya ragu, tapi setelah mencoba sendiri ternyata hasilnya di luar ekspektasi. Keren!'],
                ['name' => 'Andi Susanto', 'text' => 'Layanannya sangat memuaskan! Prosesnya cepat dan customer service sangat ramah.'],
                ['name' => 'Fina Rahmawati', 'text' => 'Respon cepat ketika ada kendala. Sangat profesional dan terpercaya.'],
                ['name' => 'Eka Putra', 'text' => 'Pengalaman pengguna yang luar biasa. Sangat mulus dan tanpa lag!'],
                ['name' => 'Dewi Lestari', 'text' => 'Desainnya elegan dan modern. Klien saya sangat suka melihatnya.'],
            ];
        @endphp
        <section class="mt-20 md:mt-28 mb-28">
            <div class="flex flex-col md:flex-row  gap-8 md:gap-10">
                <div class="w-full md:w-1/2 flex justify-center items-center"  data-aos="fade-right">
                    <img src="{{ asset('images/icon/aboutus.png') }}" alt="" class="grayscale hover:grayscale-0 transition duration-300 w-full rounded-xl">
                </div>
                <div class="w-full md:w-1/2"  data-aos="fade-left">
                    <h1 class="font-bold text-2xl md:text-3xl text-[#003049]">Mau jalan-jalan? Kami bikin <br class="hidden md:block"> semuanya jadi lebih mudah.</h1>
                    <p class="my-3 text-sm md:text-base">Pilih mobil yang kamu suka, tentukan tanggal perjalanan, dan <br class="hidden md:block"> biarkan kami menyiapkan kendaraan terbaik untuk menemani <br class="hidden md:block"> perjalananmu di Bali.</p>
                    <div class="space-y-4 mt-6">
                        <div class="flex items-center space-x-3">
                            <div class="font-bold text-sm text-white min-w-[32px] h-8 flex items-center justify-center rounded-full bg-[#003049]">
                                <h1>1</h1>
                            </div>
                            <h1 class="font-bold text-lg text-[#003049]">Pilih Mobil</h1>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="font-bold text-sm text-white min-w-[32px] h-8 flex items-center justify-center rounded-full bg-[#003049]">
                                <h1>2</h1>
                            </div>
                            <h1 class="font-bold text-lg text-[#003049]">Tentukan Jadwal</h1>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="font-bold text-sm text-white min-w-[32px] h-8 flex items-center justify-center rounded-full bg-[#003049]">
                                <h1>3</h1>
                            </div>
                            <h1 class="font-bold text-lg text-[#003049]">Konfirmasi & Book</h1>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="font-bold text-sm text-white min-w-[32px] h-8 flex items-center justify-center rounded-full bg-[#003049]">
                                <h1>4</h1>
                            </div>
                            <h1 class="font-bold text-lg text-[#003049]">Siap Jalan!!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

   
<section class="max-w-5xl relative mx-auto bg-slate-50 py-16 overflow-hidden">

   

    <div class="text-center mb-8">

        <h2 class="text-3xl font-bold text-slate-800">Bukan kami yang <span class="text-red-500">bilang</span></h2>

        <h2 class="text-3xl font-bold text-slate-800">Tapi mereka yang rasain</h2>

    </div>
    <div class="swiper mySwiper w-full max-w-6xl mx-auto px-4">

        <div class="swiper-wrapper">

            @foreach($testimonials as $testi)
                <div

                    class="swiper-slide bg-slate-900 rounded-xl p-8 flex flex-col justify-center items-center text-center shadow-xl cursor-grab active:cursor-grabbing border-b-4 border-transparent hover:border-red-500 transition-all"

                    style="width: 350px; height: 310px;"

                >
                    <svg class="w-12 h-12 text-red-500 mb-6 self-start" fill="currentColor" viewBox="0 0 24 24">

                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />

                    </svg>
                    <p class="text-slate-200 italic mb-8 text-sm md:text-base leading-relaxed">

                        {{ $testi['text'] }}

                    </p>
                    <h3 class="text-white font-semibold text-lg mt-auto">

                        - {{ $testi['name'] }}
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
    <section class="mt-20 md:mt-28 text-center md:text-left max-w-5xl mx-auto">
            <h1 class="font-bold text-[24px] md:text-[28px] text-[#003049]">Siap Menjelah <span class="text-[#D62828]">Bali?</span></h1>
            <p>Temukan Kendaraan Yang Sesuai Untuk Perjalanannmu</p>
        </section> <br> 

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.842199607715!2d115.19889267342089!3d-8.611144687475818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f27fa9596c3%3A0xb3151d3d8bec22a6!2sBanjar%20Tulangampiang!5e0!3m2!1sid!2sid!4v1786975741184!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>

    <footer class="mt-5 pb-10">
        <div class="max-w-5xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-16">
               
                <div>
                    <img src="{{ asset('images/logo/logo.png') }}" alt="Adprent Bali" class="w-36 mb-5">
                    <p class="text-sm text-justify">
                        Adprent Bali hadir untuk membuat perjalanan Anda di Bali menjadi lebih mudah, nyaman, dan bebas khawatir. Dengan kendaraan yang terawat, serta driver profesional, kami siap menemani setiap perjalanan Anda.
                    </p>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-5 md:mb-10">Kontak</h2>
                    <div class="space-y-3 text-sm">
                        <p>Instagram: <span class="font-medium">@adprentbali</span></p>
                        <p>WhatsApp: <span class="font-medium">+62 812-3456-789</span></p>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg font-semibold mb-5 md:mb-8">Jam Operasional</h2>
                    <p class="text-sm leading-7">
                        Senin - Minggu <br>
                        <span class="font-medium">09:00 - 22:00 WITA</span>
                    </p>
                    <p class="text-sm mt-4">
                        Siap membantu kebutuhan perjalanan Anda di Bali.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
     AOS.init();
    </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
 
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (hamburgerBtn && mobileMenu) {
            hamburgerBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                mobileMenu.classList.toggle('flex');
            });
        }

        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileButton && profileDropdown) {
            profileButton.addEventListener('click', function (event) {
                event.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', function (event) {
                if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }

        var swiper = new Swiper('.mySwiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto', 
            loop: true,
            loopSlides: 6,
            coverflowEffect: {
                rotate: 30,    
                stretch: -15,  
                depth: 300,    
                modifier: 1,
                scale: 0.9,
                slideShadows: false, 
            },
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>
</body>
</html>