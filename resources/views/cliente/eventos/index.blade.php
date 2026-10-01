@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
</head>

<body>
    <div class="hero-section">
        <video class="background-video" autoplay loop muted playsinline>
            <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
            Tu navegador no soporta el formato de video.
        </video>
        <div class="content">
            <h1>EVENTOS DISPONIBLES</h1>
        </div>
    </div>

    <section class="conten">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="container mt-5">
            @foreach ($eventos as $evento)
            <div class="card shadow mb-4">
                <div class="card-body">
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Tipo:</strong> {{ $evento->tipo }}</li>
                        <li class="list-group-item"><strong>Descripción:</strong> {{ $evento->descripcion }}</li>
                        <li class="list-group-item"><strong>Fecha:</strong> {{ $evento->fecha_inicio }} - {{ $evento->fecha_fin }}</li>
                        <li class="list-group-item"><strong>Hora:</strong> {{ $evento->hora_inicio }} - {{ $evento->hora_fin }}</li>
                        <li class="list-group-item">
                            <strong>Cupo:</strong>
                            {{ $evento->cupo_disponible }} disponibles de {{ $evento->cupo_maximo }}
                            @if($evento->cupo_disponible <= 0)
                                <span class="badge bg-danger ms-2">CUPO LLENO</span>
                                @endif
                        </li>
                        <li class="list-group-item"><strong>Encargado:</strong> {{ $evento->encargado }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $evento->telefono }}</li>
                        <li class="list-group-item"><strong>Sucursal:</strong> {{ $evento->sucursal->nombre }}</li>
                    </ul>

                    @if ($evento->registrado)
                    <div class="alert alert-success" role="alert">
                        ¡Ya estás registrado en este evento!
                    </div>
                    <form method="POST" action="{{ route('registro-evento.cancelar', ['eventoId' => $evento->id_evento]) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm mt-2">
                            Cancelar registro
                        </button>
                    </form>
                    @elseif ($evento->tipo === 'capacitacion')
                    @if (!$evento->cupo_disponible)
                    <div class="alert alert-warning" role="alert">
                        Evento con cupo al máximo.
                    </div>
                    @else
                    <form method="POST" action="{{ route('registro-evento', ['eventoId' => $evento->id_evento]) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </form>
                    @endif
                    @else
                    <div class="alert alert-warning" role="alert">
                        Registro disponible solo para eventos de tipo capacitación.
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <!-- 🔥 Agregar los controles de paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $eventos->links() }}
        </div>

    </section>

</body>

<style>
    .conten {
        background-color: #f8f9fa;
        padding: 60px 20px;
    }
</style>
@endsection