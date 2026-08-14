<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/3.0.1/css/dataTables.dataTables.css" />
  </head>
  <body>
    
      <div class="grid grid-cols-12">
        <div class="col-span-2">
          @include('layout.components.sidebar')
        </div>
        <div class="col-span-10">
          @include('layout.components.navbar')
          @yield('content')
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