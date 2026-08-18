<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/3.0.1/css/dataTables.dataTables.css" />
  </head>
  <body class="bg-gray-50">
    
      <!-- Ubah dari grid menjadi flex container -->
      <div class="flex min-h-screen">
        
        <!-- Sidebar (Lebar tetap, misal w-64 atau w-1/5) -->
        <div class="w-64 flex-shrink-0">
          @include('layout.components.sidebar')
        </div>

        <!-- Konten Utama (Mengambil sisa layar) -->
        <div class="flex-1 flex flex-col min-w-0">
          @include('layout.components.navbar')
          
          <main class="p-6">
            @yield('content')
          </main>
        </div>

      </div>

   <script>
    lucide.createIcons();
   </script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js" integrity="sha512-8LENNbXmzI/Gbj+OwXmqR6V4QaUAw0/porPzy1+dQoJqC0JPHedWoe0DDOTL2uHA5XXJyIsPtiMHH86pVlay6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdn.datatables.net/3.0.1/js/dataTables.js"></script>

   <script>
    document.querySelectorAll('.datatable').forEach(table => {
        new DataTable(table);
    });
   </script>
  </body>
</html>