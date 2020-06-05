<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ResultManagement System</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper" id="app">
    @include('layouts/partials/navbar')
    @include('layouts/partials/sidebar')
    @yield('content')
    @include('layouts/partials/footer')
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
  <script>
    $(document).ready( function () {
    $('#table_id').DataTable();
    } );
  </script>
  <script>
    $(document).ready(()=>{
    setTimeout(()=>{
    $('.alert').slideUp()
    },4000);
    });
  </script>

</body>

</html>