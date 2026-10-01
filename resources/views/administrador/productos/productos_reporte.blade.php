<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Productos</title>
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
    <h1>Reporte de Productos</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Sucursal</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->sucursal->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->categoria }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>