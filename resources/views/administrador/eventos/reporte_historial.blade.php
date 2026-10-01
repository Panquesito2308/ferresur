<!DOCTYPE html>
<html>

<head>
    <title>Historial de Eventos - Ferresur</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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

        h2 {
            color: #FF6B00;
            font-size: 20px;
            margin-top: 30px;
            margin-bottom: 10px;
            border-left: 4px solid #FF6B00;
            padding-left: 10px;
        }

        h3 {
            color: #333333;
            font-size: 16px;
            margin-top: 20px;
            margin-bottom: 10px;
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
            margin-top: 15px;
            margin-bottom: 30px;
            font-size: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #FF6B00;
            color: #FFFFFF;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            border: 1px solid #E0E0E0;
        }

        td {
            border: 1px solid #E0E0E0;
            padding: 10px 8px;
            text-align: left;
            color: #333333;
        }

        tr:nth-child(even) {
            background-color: #F9F9F9;
        }

        tr:hover {
            background-color: #FFF3E8;
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

        .event-details {
            background-color: #F9F9F9;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 3px solid #FF6B00;
        }

        .event-details p {
            margin: 5px 0;
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
            margin-left: 10px;
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #E0E0E0;
            margin: 30px 0;
        }

        .no-registros {
            background-color: #F5F5F5;
            padding: 10px;
            text-align: center;
            font-style: italic;
            color: #666666;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- Usar base64 encode directamente -->
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo_comp.png'))) }}" alt="Logo Ferresur" class="logo">
        <h1>Historial de Eventos</h1>
        <div class="subtitle">Registro de Participantes • Generado el {{ date('d/m/Y H:i') }}</div>
    </div>

    <div class="info-box">
        <h3>Reporte Consolidado de Eventos</h3>
        <p>Este documento contiene el historial completo de eventos realizados por <span class="highlight">Ferresur</span>, incluyendo la lista de participantes registrados en cada actividad.</p>
    </div>

    @foreach ($eventos as $evento)
    <div class="event-section">
        <h2>{{ $evento->tipo }} <span class="badge">{{ $evento->registros->count() }} PARTICIPANTES</span></h2>

        <div class="event-details">
            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
            <p><strong>Fechas:</strong> {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}</p>
            <p><strong>Horario:</strong> {{ $evento->hora_inicio }} - {{ $evento->hora_fin }}</p>
            <p><strong>Lugar:</strong> {{ $evento->sucursal->nombre ?? 'No asignada' }}</p>
            <p><strong>Contacto:</strong> {{ $evento->encargado }} ({{ $evento->telefono }})</p>
        </div>

        <h3>Participantes Registrados:</h3>
        @if ($evento->registros->isEmpty())
        <div class="no-registros">No hay registros para este evento.</div>
        @else
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Contacto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evento->registros as $registro)
                <tr>
                    <td>
                        {{ $registro->cliente ? $registro->cliente->nombre : ($registro->empleado ? $registro->empleado->nombre : 'No disponible') }}
                        {{ $registro->cliente ? $registro->cliente->apellidos : ($registro->empleado ? $registro->empleado->apellidos : '') }}
                    </td>
                    <td>
                        {{ $registro->cliente ? 'Cliente' : ($registro->empleado ? 'Empleado' : 'No disponible') }}
                        @if($registro->asistio)
                        <span class="badge" style="background-color: #27ae60;">ASISTIÓ</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($registro->fecha_registro)->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($registro->cliente)
                        {{ $registro->cliente->telefono ?? 'Sin teléfono' }}
                        @elseif($registro->empleado)
                        {{ $registro->empleado->telefono ?? 'Sin teléfono' }}
                        @else
                        No disponible
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <hr>
    @endforeach

    <div class="footer">
        <strong>Ferresur © {{ date('Y') }}</strong> • Todos los derechos reservados<br>
        Periférico Oriente Sur S/N B. Candelaria • Teléfono: (919) 673-06-69 / 673-04-29 • www.ferresur.org<br>
        Documento generado automáticamente • Uso interno
    </div>
</body>

</html>