<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Clientes - Ferresur</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            color: #000000;
            /* Negro para texto principal */
            line-height: 1.5;
            background-color: #FFFFFF;
            /* Fondo blanco */
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #FF6B00;
            /* Naranja Ferresur */
            padding-bottom: 15px;
        }

        .logo {
            max-width: 180px;
            margin-bottom: 15px;
        }

        h1 {
            color: #FF6B00;
            /* Naranja Ferresur */
            margin: 0;
            font-size: 28px;
            text-transform: uppercase;
        }

        .subtitle {
            color: #666666;
            /* Gris medio */
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
            /* Sombra sutil */
        }

        th {
            background-color: #FF6B00;
            /* Naranja Ferresur */
            color: #FFFFFF;
            /* Texto blanco */
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            border: 1px solid #E0E0E0;
            /* Gris claro */
        }

        td {
            border: 1px solid #E0E0E0;
            /* Gris claro */
            padding: 10px 8px;
            text-align: center;
            color: #333333;
            /* Gris oscuro casi negro */
        }

        tr:nth-child(even) {
            background-color: #F9F9F9;
            /* Gris muy claro */
        }

        tr:hover {
            background-color: #FFF3E8;
            /* Naranja muy claro al pasar mouse */
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 11px;
            color: #666666;
            /* Gris medio */
            border-top: 1px solid #E0E0E0;
            /* Gris claro */
            padding-top: 15px;
        }

        .info-box {
            background-color: #F5F5F5;
            /* Gris claro */
            border-left: 4px solid #FF6B00;
            /* Naranja Ferresur */
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 0 4px 4px 0;
        }

        .info-box h3 {
            color: #FF6B00;
            /* Naranja Ferresur */
            margin-top: 0;
            font-size: 16px;
        }

        .highlight {
            color: #FF6B00;
            /* Naranja Ferresur */
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <!-- Logo de Ferresur -->
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('img/logo_comp.png'))) }}" alt="Logo Ferresur" class="logo">
        <h1>Reporte de Clientes</h1>
        <div class="subtitle">Sistema de Gestión Comercial • Generado el {{ date('d/m/Y H:i') }}</div>
    </div>

    <div class="info-box">
        <h3>Resumen Ejecutivo Ferresur</h3>
        <p>Este reporte contiene los datos de clientes registrados en el sistema de <span class="highlight">Ferresur</span>, empresa líder en distribución de materiales ferreteros con más de 15 años en el mercado. El documento refleja información actualizada al día de generación.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Nombre Completo</th>
                <th>Contacto</th>
                <th>Ubicación</th>
                <th>Edad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td><strong>{{ $cliente->usuario->username ?? 'N/A' }}</strong></td>
                <td>
                    {{ $cliente->nombre }} {{ $cliente->apellidos }}<br>
                </td>
                <td>
                    {{ $cliente->telefono }}<br>
                    <small>{{ $cliente->email ?? 'Sin email' }}</small>
                </td>
                <td>
                    {{ $cliente->direccion }}<br>
                    {{ $cliente->ciudad }}, {{ $cliente->estado }}<br>
                    CP: {{ $cliente->codigo_postal }}
                </td>
                <td>{{ $cliente->edad }} años<br>
                    <small>Nac: {{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</small>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <strong>Ferresur © {{ date('Y') }}</strong> • Todos los derechos reservados<br>
        Periférico Oriente Sur S/N
        B. candelaria• Teléfono: (919) 673-06-69
        673-04-29 • www.ferresur.org<br>
        Documento generado automáticamente • Confidencial
    </div>
</body>

</html>