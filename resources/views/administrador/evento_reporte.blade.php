<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Eventos - Ferresur</title>
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

        .info-box h3 {
            color: #FF6B00;
            margin-top: 0;
            font-size: 16px;
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

        .fechas {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo_comp.png'))) }}" alt="Logo Ferresur" class="logo">
        <h1>Reporte de Eventos</h1>
        <div class="subtitle">Gestión de Eventos • Generado el {{ date('d/m/Y H:i') }}</div>
    </div>

    <div class="info-box">
        <h3>Calendario de Eventos Ferresur</h3>
        <p>Este documento contiene el listado completo de eventos programados en <span class="highlight">Ferresur</span>, incluyendo capacitaciones, promociones especiales y actividades para clientes.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Fechas</th>
                <th>Horario</th>
                <th>Cupo</th>
                <th>Responsable</th>
                <th>Sucursal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eventos as $evento)
            <tr>
                <td>
                    <strong>{{ $evento->tipo }}</strong>
                    @if($evento->prioridad == 'alta')
                    <br><span class="badge">PRIORITARIO</span>
                    @endif
                </td>
                <td>{{ $evento->descripcion }}</td>
                <td class="fechas">
                    Inicio: {{ \Carbon\Carbon::parse($evento->fecha_inicio)->format('d/m/Y') }}<br>
                    Fin: {{ \Carbon\Carbon::parse($evento->fecha_fin)->format('d/m/Y') }}
                </td>
                <td class="fechas">
                    {{ $evento->hora_inicio }} - {{ $evento->hora_fin }}
                </td>
                <td>
                    {{ $evento->cupo }}<br>
                    <small>Disponibles: {{ $evento->cupo_disponible ?? $evento->cupo }}</small>
                </td>
                <td>
                    {{ $evento->encargado }}<br>
                    <small>{{ $evento->telefono }}</small>
                </td>
                <td>{{ $evento->sucursal->nombre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <strong>Ferresur © {{ date('Y') }}</strong> • Todos los derechos reservados<br>
        Periférico Oriente Sur S/N B. Candelaria • Teléfono: (919) 673-06-69 / 673-04-29 • www.ferresur.org<br>
        Documento generado automáticamente • Confidencial
    </div>
</body>

</html>