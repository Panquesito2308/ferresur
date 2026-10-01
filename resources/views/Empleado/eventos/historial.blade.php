@extends('layouts.app-master')

@section('content')

<style>
    .conten {
        background-color: #f8f9fa;
        padding: 60px 20px;
    }



    .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        text-align: center;
    }

    .parallax-text {
        font-size: 75px;
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;

    }
</style>


<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
</head>

<body>
    <div class="hero-section">
        <!-- Video de fondo -->
        <video class="background-video" autoplay loop muted playsinline>
            <source src="{{ asset('img/banners/fondo.mov') }}" type="video/mp4">
            Tu navegador no soporta el formato de video.
        </video>
        <!-- Contenido -->
        <div class="content">
            <h1>HISTORIAL DE EVENTO</h1>
        </div>
    </div>

    <section class="conten">

        @if($eventos->isEmpty())
        <div class="alert alert-warning">No tienes eventos registrados.</div>
        @else
        @foreach ($eventos as $evento)
        <div class="card shadow mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $evento->tipo }}</h5>
                <p class="card-text">{{ $evento->descripcion }}</p>
                <p><strong>Fecha:</strong> {{ $evento->fecha_inicio }} - {{ $evento->fecha_fin }}</p>
                <p><strong>Hora:</strong> {{ $evento->hora_inicio }} - {{ $evento->hora_fin }}</p>
                <p><strong>Encargado:</strong> {{ $evento->encargado }}</p>
                <p><strong>Sucursal:</strong> {{ $evento->sucursal->nombre }}</p>
            </div>
        </div>
        @endforeach
        @endif
        </div>
    </section>
</body>
@endsection