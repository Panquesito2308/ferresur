<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ferresur</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Otros enlaces -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.19/dist/sweetalert2.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/img/logo_icon.png') }}" type="image/png">

</head>

<body>
    @include('layouts.partials.navbar')
    <main class="containeer">
        @yield('content')
    </main>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    @include('layouts.partials.footer') <!-- Incluir el footer -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

<style>
    .containeer {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        min-height: 70vh;
    }

    img {
        display: block;
    }
</style>