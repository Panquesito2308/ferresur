@extends('layouts.app-master')

@section('content')
<h1>Mis Eventos Registrados</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@elseif(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if($registros->isEmpty())
<p>No estás registrado en ningún evento aún.</p>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Evento</th>
            <th>Fecha</th>
            <th>Ubicación</th>
            <th>Fecha de Registro</th>
        </tr>
    </thead>
    <tbody>@extends('layouts.app-master')

        @section('content')
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-body">
                    <h2 class="card-title text-primary mb-4">{{ $evento->nombre }}</h2>

                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Fecha:</strong> {{ $evento->fecha_inicio }} - {{ $evento->fecha_fin }}</li>
                        <li class="list-group-item"><strong>Hora:</strong> {{ $evento->hora_inicio }} - {{ $evento->hora_fin }}</li>
                        <li class="list-group-item"><strong>Cupo:</strong> {{ $evento->cupo }}</li>
                        <li class="list-group-item"><strong>Encargado:</strong> {{ $evento->encargado }}</li>
                        <li class="list-group-item"><strong>Teléfono:</strong> {{ $evento->telefono }}</li>
                        <li class="list-group-item"><strong>Sucursal:</strong> {{ $evento->sucursal->nombre }}
                        </li>
                    </ul>

                    @if (isset($registrado) && $registrado)
                    <div class="alert alert-success" role="alert">
                        ¡Ya estás registrado en este evento!
                    </div>
                    @else
                    <div class="alert alert-warning" role="alert">
                        No estás registrado en este evento.
                    </div>
                    <form method="POST" action="{{ route('registro-evento', ['eventoId' => $evento->id_evento]) }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            Registrar
                        </button>
                    </form>
                    @endif
                    @endsection
                    @foreach ($registros as $registro)
                    <tr>
                        <td>{{ $registro->evento->nombre }}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->evento->fecha_evento)->format('d/m/Y') }}</td>
                        <td>{{ $registro->evento->ubicacion }}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->fecha_registro)->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
    </tbody>
</table>
@endif
@endsection