<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Evento - {{ $evento->tipo }} - Ferresur</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            color: #000000;
            line-height: 1.5;
            background-color: #FFFFFF;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #FF6B00;
            padding-bottom: 15px;
        }

        .logo {
            max-width: 180px;
            margin-bottom: 15px;
        }

        h1 {
            color: #FF6B00;
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
        }

        .subtitle {
            color: #666666;
            font-size: 14px;
            margin-top: 8px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
            font-size: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #FF6B00;
            color: #FFFFFF;
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            border: 1px solid #E0E0E0;
        }

        td {
            border: 1px solid #E0E0E0;
            padding: 10px 8px;
            text-align: center;
            color: #333333;
        }

        tr:nth-child(even) {
            background-color: #F9F9F9;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #666666;
            border-top: 1px solid #E0E0E0;
            padding-top: 15px;
        }

        .info-box {
            background-color: #F5F5F5;
            border-left: 4px solid #FF6B00;
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 0 4px 4px 0;
        }

        .highlight {
            color: #FF6B00;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            background-color: #FF6B00;
            color: white;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }

        .participants-table th,
        .participants-table td {
            text-align: left;
            padding: 8px;
        }

        .event-details {
            margin-bottom: 20px;
        }

        .event-details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo_comp.png'))) }}" alt="Logo Ferresur" class="logo">
        <h1>Reporte de Evento: {{ $evento->tipo }}</h1>
        <div class="subtitle">Detalles completos • Generado el {{ date('d/m/Y H:i') }}</div>
    </div>

    <div class="info-box">
        <h3>Información General del Evento</h3>
        <div class="event-details">
            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Fechas:</strong> {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}</p>
            <p><strong>Horario:</strong> {{ $evento->hora_inicio }} - {{ $evento->hora_fin }}</p>
            <p><strong>Lugar:</strong> {{ $evento->sucursal->nombre ?? 'No asignada' }}</p>
            <p><strong>Contacto:</strong> {{ $evento->telefono }}</p>
        </div>
    </div>

    <h3 style="color: #FF6B00; margin-top: 30px;">Participantes Registrados ({{ $evento->registros->count() }})</h3>

    @if($evento->registros->isEmpty())
    <p>No hay registros para este evento.</p>
    @else
    <table class="participants-table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evento->registros as $registro)
            <tr>
                <td>
                    {{ $registro->cliente ? $registro->cliente->nombre : ($registro->empleado ? $registro->empleado->nombre : 'No disponible') }}
                </td>
                <td>
                    {{ $registro->cliente ? 'Cliente' : ($registro->empleado ? 'Empleado' : 'No disponible') }}
                </td>
                <td>{{ $registro->fecha_registro }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="footer">
        <strong>Ferresur © {{ date('Y') }}</strong> • Todos los derechos reservados<br>
        Periférico Oriente Sur S/N B. Candelaria • Teléfono: (919) 673-06-69 / 673-04-29 • www.ferresur.org<br>
        Documento confidencial • Uso interno
    </div>
</body>

</html>