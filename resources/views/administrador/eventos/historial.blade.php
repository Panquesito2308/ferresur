@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Paleta de colores */
        :root {
            --color-primary: #FF7F32;
            /* Naranja */
            --color-secondary: #2C3E50;
            /* Negro azulado */
            --color-light: #F8F9FA;
            /* Gris claro */
            --color-dark: #212529;
            /* Negro */
            --color-white: #FFFFFF;
            /* Blanco */
            --color-danger: #DC3545;
            /* Rojo */
            --color-success: #28A745;
            /* Verde */
        }

        /* Estructura principal */
        .history-container {
            background-color: var(--color-white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        /* Cards de eventos */
        .event-card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .event-card-header {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1rem 1.5rem;
            border-bottom: 3px solid var(--color-primary);
        }

        .event-card-body {
            padding: 1.5rem;
        }

        /* Botones */
        .btn-history {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.85rem;
        }

        .btn-primary-history {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary-history:hover {
            background-color: #E06A1B;
            border-color: #E06A1B;
        }

        .btn-outline-danger-history {
            border: 1px solid var(--color-danger);
            color: var(--color-danger);
            background-color: transparent;
        }

        .btn-outline-danger-history:hover {
            background-color: var(--color-danger);
            color: var(--color-white);
        }

        /* Tabla de registros */
        .registros-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 1rem;
        }

        .registros-table thead th {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .registros-table tbody tr {
            transition: all 0.2s ease;
        }

        .registros-table tbody tr:hover {
            background-color: rgba(255, 127, 50, 0.05);
        }

        .registros-table tbody td {
            padding: 0.75rem;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
            font-size: 0.85rem;
        }

        /* Badges */
        .badge-history {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 500;
            border-radius: 4px;
        }

        .badge-primary-history {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        /* Información del evento */
        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .event-meta-item i {
            color: var(--color-primary);
        }

        /* Contador de registros */
        .registros-count {
            font-weight: 600;
            color: var(--color-primary);
            margin: 1rem 0;
        }

        /* Estilos para el botón naranja */
        .btn-orange {
            background-color: #FF7F32 !important;

            /* Color naranja principal */
            border: 1px solid #E06A1B;
            /* Borde más oscuro */
            color: white !important;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-size: 0.85rem;
        }

        /* Efecto hover */
        .btn-orange:hover {
            background-color: #E06A1B;
            /* Ton más oscuro al pasar mouse */
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        /* Estilo para el icono dentro del botón */
        .btn-orange i {
            margin-right: 5px;
            font-size: 0.9em;
        }

        /* Versión outline para contraste */
        .btn-orange-outline {
            background-color: transparent;
            border: 1px solid #FF7F32;
            color: #FF7F32 !important;
        }

        .btn-orange-outline:hover {
            background-color: #FF7F32;
            color: white !important;
        }

        /* Tamaño pequeño */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .btn-orange:hover i {
            animation: bounce 0.5s ease;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-2px);
            }
        }
    </style>
</head>

<div class="container py-4">
    <div class="history-container p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0"><i class="bi bi-clock-history me-2"></i>Historial de Eventos</h1>
            <a href="{{ route('eventos.historial.reporte') }}" class="btn btn-outline-danger-history btn-history">
                <i class="fas fa-file-pdf me-1"></i> Generar Reporte PDF
            </a>
        </div>

        @forelse ($eventos as $evento)
        <div class="event-card">
            <div class="event-card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <span class="badge badge-primary-history badge-history me-2">{{ $evento->tipo }}</span>
                    {{ $evento->descripcion }}
                </h5>
                <a href="{{ route('eventos.pdf', $evento->id_evento) }}" class="btn btn-orange btn-sm">
                    <i class="fas fa-download me-1"></i> <!-- Font Awesome -->
                    Descargar lista
                </a>
            </div>

            <div class="event-card-body">
                <div class="event-meta">
                    <div class="event-meta-item">
                        <i class="bi bi-calendar"></i>
                        <span>
                            <strong>Fecha:</strong>
                            {{ date('d/m/Y', strtotime($evento->fecha_inicio)) }} -
                            {{ date('d/m/Y', strtotime($evento->fecha_fin)) }}
                        </span>
                    </div>
                    <div class="event-meta-item">
                        <i class="bi bi-clock"></i>
                        <span>
                            <strong>Hora:</strong>
                            {{ date('H:i', strtotime($evento->hora_inicio)) }} -
                            {{ date('H:i', strtotime($evento->hora_fin)) }}
                        </span>
                    </div>
                    <div class="event-meta-item">
                        <i class="bi bi-telephone"></i>
                        <span><strong>Teléfono:</strong> {{ $evento->telefono }}</span>
                    </div>
                    <div class="event-meta-item">
                        <i class="bi bi-shop"></i>
                        <span><strong>Sucursal:</strong> {{ $evento->sucursal->nombre ?? 'No asignada' }}</span>
                    </div>
                </div>

                <h6 class="registros-count">
                    <i class="bi bi-people-fill me-2"></i>
                    Registrados: {{ $evento->registros->count() }}
                </h6>

                @if ($evento->registros->isEmpty())
                <div class="alert alert-secondary">
                    <i class="bi bi-info-circle me-2"></i>No hay registros para este evento.
                </div>
                @else
                <div class="table-responsive">
                    <table class="registros-table">
                        <thead>
                            <tr>
                                <th class="text-start">Nombre</th>
                                <th class="text-center">Rol</th>
                                <th class="text-center">Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($evento->registros as $registro)
                            <tr>
                                <td class="text-start">
                                    {{ $registro->cliente ? $registro->cliente->nombre : ($registro->empleado ? $registro->empleado->nombre : 'No disponible') }}
                                </td>
                                <td class="text-center">
                                    @if($registro->cliente)
                                    <span class="badge badge-primary-history badge-history">Cliente</span>
                                    @elseif($registro->empleado)
                                    <span class="badge badge-primary-history badge-history">Empleado</span>
                                    @else
                                    No disponible
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ date('d/m/Y H:i', strtotime($registro->fecha_registro)) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="alert alert-secondary text-center py-4">
            <i class="bi bi-calendar-x me-2"></i>No hay eventos en el historial.
        </div>
        @endforelse
    </div>
</div>
@endsection