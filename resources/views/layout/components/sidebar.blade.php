<aside class="min-h-screen bg-slate-900 p-5 text-white">
    <h1 class="mb-8 text-xl font-bold">
        AdpRental.
    </h1>

    <nav>
        <ul class="space-y-2">
            <li>
                 
                <a href="{{ url('/') }}"
                   class="flex items-center gap-2 rounded-lg px-4 py-3 hover:bg-slate-800">
                   <i data-lucide="layout-dashboard"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('mobil.index') }}"
                   class="flex items-center gap-2 rounded-lg px-4 py-3 hover:bg-slate-800">
                   <i data-lucide="car-front"></i>

                    Data Mobil
                </a>
            </li>

            <li>
                <a href="{{ route('pelanggan.index') }}"
                   class="flex items-center gap-2 rounded-lg px-4 py-3 hover:bg-slate-800 text-[15px]">
                      <i data-lucide="users"></i>
                    Data Pelanggan
                </a>
            </li>

            <li>
                <a href="{{ route('penyewaan.index') }}"
                   class="flex items-center gap-2 rounded-lg px-4 py-3 hover:bg-slate-800 text-[15px]">
                    <i data-lucide="file-text"></i>
                    Data Penyewaan
                </a>
            </li>
        </ul>
    </nav>
</aside>