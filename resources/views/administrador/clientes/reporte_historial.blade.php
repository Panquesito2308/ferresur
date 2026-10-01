<!DOCTYPE html>
<html>

<head>
    <title>Reporte Historial de Eventos del Cliente</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Historial de Eventos del Cliente</h1>
    @foreach ($eventos as $evento)
    <div>
        <h2>{{ $evento->tipo }} - {{ $evento->descripcion }}</h2>
        <p><strong>Fecha:</strong> {{ $evento->fecha_inicio }} - {{ $evento->fecha_fin }}</p>
        <p><strong>Hora:</strong> {{ $evento->hora_inicio }} - {{ $evento->hora_fin }}</p>
        <p><strong>Teléfono:</strong> {{ $evento->telefono }}</p>
        <p><strong>Sucursal:</strong> {{ $evento->sucursal->nombre ?? 'No asignada' }}</p>
    </div>
    <hr>
    @endforeach
</body>

</html>