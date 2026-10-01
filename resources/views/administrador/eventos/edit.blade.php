@extends('layouts.app-master')

@section('content')

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
    <h1>Editar evento</h1>
    <form action="{{ route('administrador.eventos.update', $evento->id_evento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="tipo">Tipo de evento</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="capacitacion" {{ $evento->tipo == 'capacitacion' ? 'selected' : '' }}>Capacitación</option>
                <option value="aniversario" {{ $evento->tipo == 'aniversario' ? 'selected' : '' }}>Aniversario</option>
            </select>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $evento->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="fecha_inicio">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $evento->fecha_inicio }}">
        </div>

        <div class="form-group">
            <label for="fecha_fin">Fecha de finalización</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ $evento->fecha_fin }}">
        </div>

        <div class="form-group">
            <label for="hora_inicio">Hora de inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ $evento->hora_inicio }}">
        </div>

        <div class="form-group">
            <label for="hora_fin">Hora de finalización</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" value="{{ $evento->hora_fin }}">
        </div>

        <div class="form-group">
            <label for="cupo">Cupo máximo</label>
            <input type="number" name="cupo" id="cupo" class="form-control" value="{{ $evento->cupo }}">
        </div>

        <div class="form-group">
            <label for="encargado">Encargado</label>
            <select name="encargado" id="encargado" class="form-control" onchange="mostrarCampoEncargado()">
                <option value="">-- Seleccione un encargado --</option>
                @foreach ($empleados as $empleado)
                <option value="{{ $empleado->nombre }}" {{ $empleado->nombre == $evento->encargado ? 'selected' : '' }}>
                    {{ $empleado->nombre }} {{ $empleado->apellidos }}
                </option>
                @endforeach
                <option value="otro" {{ !in_array($evento->encargado, $empleados->pluck('nombre')->toArray()) ? 'selected' : '' }}>
                    Otro
                </option>
            </select>

            <div class="form-group" id="manual-encargado-field" style="display: none;">
                <label for="manual_encargado">Nombre del encargado</label>
                <input type="text" id="manual_encargado" class="form-control"
                    value="{{ !in_array($evento->encargado, $empleados->pluck('nombre')->toArray()) ? $evento->encargado : '' }}"
                    name="manual_encargado">
            </div>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono de contacto</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $evento->telefono }}">
        </div>

        <div class="form-group">
            <label for="id_sucursal">Sucursal</label>
            <select name="id_sucursal" id="id_sucursal" class="form-control">
                @foreach ($sucursales as $sucursal)
                <option value="{{ $sucursal->id_sucursal }}" {{ $evento->id_sucursal == $sucursal->id_sucursal ? 'selected' : '' }}>
                    {{ $sucursal->nombre }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar evento</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        mostrarCampoEncargado();
    });

    function mostrarCampoEncargado() {
        const encargadoSelect = document.getElementById('encargado');
        const manualEncargadoField = document.getElementById('manual-encargado-field');
        const manualEncargadoInput = document.getElementById('manual_encargado');

        if (encargadoSelect.value === 'otro') {
            manualEncargadoField.style.display = 'block';
            manualEncargadoInput.setAttribute('required', 'required');
        } else {
            manualEncargadoField.style.display = 'none';
            manualEncargadoInput.removeAttribute('required');
        }
    }
</script>
@endsection