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

<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-4 text-dark">Crear Evento</h1>
        <form action="{{ route('administrador.eventos.store') }}" method="POST" class="border p-4 rounded bg-white">
            @csrf

            <!-- Tipo -->
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control" onchange="toggleFields()" required>
                    <option value="capacitacion">Capacitación</option>
                    <option value="aniversario">Aniversario</option>
                </select>
            </div>

            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
            </div>

            <!-- Fecha Inicio -->
            <div class="form-group">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required
                    min="{{ now()->toDateString() }}">
            </div>
            <!-- Fecha Fin -->
            <div class="form-group">
                <label for="fecha_fin">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
            </div>

            <!-- Hora Inicio -->
            <div class="form-group">
                <label for="hora_inicio">Hora Inicio</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
            </div>

            <!-- Hora Fin -->
            <div class="form-group">
                <label for="hora_fin">Hora Fin</label>
                <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
            </div>
            <!-- Sucursal -->
            <div class="form-group">
                <label for="id_sucursal">Sucursal</label>
                <select name="id_sucursal" id="id_sucursal" class="form-control" required>
                    @foreach ($sucursales as $sucursal)
                    <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Teléfono -->
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" pattern="[0-9]{10}"
                    title="El número de teléfono debe tener 10 dígitos" required>
            </div>


            <!-- Cupo (solo visible si es Capacitación) -->
            <div class="form-group" id="cupo-group" style="display: none;">
                <label for="cupo">Cupo</label>
                <input type="number" name="cupo" id="cupo" class="form-control" min="1">
            </div>

            <!-- Encargado -->
            <div class="form-group" id="encargado-group">
                <label for="encargado">Encargado</label>
                <select name="encargado" id="encargado" class="form-control" onchange="toggleManualEncargado()">
                    <option value="">Selecciona un encargado</option>
                    @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id_empleado }}">{{ $empleado->nombre }} {{ $empleado->apellidos }}</option>
                    @endforeach
                    <option value="otro">Otro</option>
                </select>
            </div>

            <!-- Encargado Manual -->
            <div class="form-group" id="manual-encargado-group" style="display: none;">
                <label for="manual_encargado">Nombre del encargado</label>
                <input type="text" name="manual_encargado" id="manual_encargado" class="form-control">
            </div>

            <!-- Botón de envío -->
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

    <script>
        // Mostrar campos dinámicos en función del tipo de evento
        function toggleFields() {
            let tipo = document.getElementById('tipo').value;
            let cupoGroup = document.getElementById('cupo-group');
            let encargadoGroup = document.getElementById('encargado-group');

            if (tipo === 'capacitacion') {
                cupoGroup.style.display = 'block';
                encargadoGroup.style.display = 'block';
            } else {
                cupoGroup.style.display = 'none';
                encargadoGroup.style.display = 'none';
                document.getElementById('nuevo_encargado').style.display = 'none';
                document.getElementById('encargado').value = "";
            }
        }

        // Mostrar input para nuevo encargado si se selecciona "Otro"
        function checkEncargado() {
            let encargado = document.getElementById('encargado').value;
            let nuevoEncargado = document.getElementById('nuevo_encargado');

            if (encargado === 'otro') {
                nuevoEncargado.style.display = 'block';
                nuevoEncargado.setAttribute('required', true);
            } else {
                nuevoEncargado.style.display = 'none';
                nuevoEncargado.removeAttribute('required');
            }
        }


        function toggleManualEncargado() {
            const encargado = document.getElementById('encargado').value;
            document.getElementById('manual-encargado-group').style.display = (encargado === 'otro') ? 'block' : 'none';
        }
        // Validación dinámica de fecha mínima para fecha fin
        document.getElementById('fecha_inicio').addEventListener('change', function() {
            let fechaInicio = this.value;
            document.getElementById('fecha_fin').setAttribute('min', fechaInicio);
        });

        // Inicializar la visibilidad de los campos
        toggleFields();
    </script>

    @endsection