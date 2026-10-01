@extends('layouts.app-master')

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