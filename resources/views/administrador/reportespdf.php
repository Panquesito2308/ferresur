<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Productos - Ferresur</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        /* Encabezado */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 15px;
        }

        .logo {
            width: 120px;
            height: auto;
        }

        .company-info {
            text-align: right;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }

        .report-title {
            font-size: 20px;
            color: #e74c3c;
            text-align: center;
            margin: 15px 0;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 12px;
            color: #7f8c8d;
        }

        /* Tabla de productos */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 12px;
        }

        th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Pie de página */
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        /* Estilos específicos para columnas */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Encabezado con logo y datos de la empresa -->
    <div class="header">
        <div>
            <img src="{{ public_path('img/logo-ferresur.png') }}" class="logo" alt="Logo Ferresur">
        </div>
        <div class="company-info">
            <h1 class="company-name">FERRESUR S.A. DE C.V.</h1>
            <p>Av. Principal #123, Col. Centro</p>
            <p>Tel: 555-123-4567 | www.ferresur.com</p>
            <p>RFC: FER123456ABC</p>
        </div>
    </div>

    <!-- Título del reporte -->
    <h2 class="report-title">REPORTE DE PRODUCTOS</h2>

    <!-- Información del reporte -->
    <div class="report-info">
        <div>Generado por: {{ Auth::user()->name }}</div>
        <div>Fecha: {{ now()->format('d/m/Y H:i:s') }}</div>
    </div>

    <!-- Tabla de productos -->
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Sucursal</th>
                <th class="text-right">Precio</th>
                <th class="text-center">Stock</th>
                <th>Categoría</th>
                <th class="text-center">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td class="text-center">{{ $producto->codigo ?? 'N/A' }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->sucursal->nombre }}</td>
                <td class="text-right">${{ number_format($producto->precio, 2) }}</td>
                <td class="text-center">{{ $producto->stock }}</td>
                <td>{{ ucfirst($producto->categoria) }}</td>
                <td class="text-center">
                    @if($producto->stock > 0)
                    <span class="text-bold" style="color: #27ae60;">Disponible</span>
                    @else
                    <span style="color: #e74c3c;">Agotado</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Resumen estadístico -->
    <div style="margin-top: 20px;">
        <table style="width: 300px; float: right;">
            <tr>
                <th style="background-color: #3498db;">Resumen</th>
                <th style="background-color: #3498db;"></th>
            </tr>
            <tr>
                <td>Total Productos:</td>
                <td class="text-right">{{ $productos->count() }}</td>
            </tr>
            <tr>
                <td>Stock Total:</td>
                <td class="text-right">{{ $productos->sum('stock') }}</td>
            </tr>
            <tr>
                <td>Valor Total:</td>
                <td class="text-right">${{ number_format($productos->sum(function($p) { return $p->precio * $p->stock; }), 2) }}</td>
            </tr>
        </table>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>Ferresur S.A. de C.V. | Reporte generado automáticamente | Página {PAGENO} de {nbpg}</p>
        <p>Este documento es confidencial y para uso exclusivo de la empresa</p>
    </div>
</body>

</html>