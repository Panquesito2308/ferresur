@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
        .event-container {
            background-color: var(--color-white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .event-header {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1.5rem;
            border-bottom: 3px solid var(--color-primary);
        }

        /* Tabla de eventos */
        .event-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .event-table thead th {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .event-table tbody tr {
            transition: all 0.2s ease;
        }

        .event-table tbody tr:hover {
            background-color: rgba(255, 127, 50, 0.05);
        }

        .event-table tbody td {
            padding: 0.75rem;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
            font-size: 0.9rem;
        }

        /* Botones y acciones */
        .btn-event {
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.85rem;
        }

        .btn-primary-event {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary-event:hover {
            background-color: #E06A1B;
            border-color: #E06A1B;
        }

        .btn-outline-event {
            border: 1px solid var(--color-primary);
            color: var(--color-primary);
            background-color: transparent;
        }

        .btn-outline-event:hover {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-outline-danger-event {
            border: 1px solid var(--color-danger);
            color: var(--color-danger);
            background-color: transparent;
        }

        .btn-outline-danger-event:hover {
            background-color: var(--color-danger);
            color: var(--color-white);
        }

        /* Badges */
        .badge-event {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 500;
            border-radius: 4px;
        }

        .badge-primary-event {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .badge-secondary-event {
            background-color: var(--color-light);
            color: var(--color-dark);
            border: 1px solid #dee2e6;
        }

        /* Alertas */
        .alert-event {
            border-left: 4px solid;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .alert-event.show {
            opacity: 1;
            transform: translateY(0);
        }

        .alert-success-event {
            background-color: rgba(40, 167, 69, 0.1);
            border-left-color: var(--color-success);
            color: #155724;
        }

        /* Paginación */
        .pagination-event .page-item.active .page-link {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .pagination-event .page-link {
            color: var(--color-secondary);
            border: 1px solid #dee2e6;
        }

        .pagination-event .page-link:hover {
            background-color: var(--color-light);
        }

        /* Fechas */
        .event-date {
            font-weight: 500;
            white-space: nowrap;
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
    @if (session('success'))
    <div class="alert-event alert-success-event" id="custom-alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
    </div>
    @endif

    <!-- Contenedor principal -->
    <div class="event-container">
        <!-- Encabezado -->
        <div class="event-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fs-4 fw-bold"><i class="bi bi-calendar-event me-2"></i>Gestión de Eventos</h2>
                <div>
                    <a href="{{ route('administrador.eventos.create') }}" class="btn btn-orange btn-sm">
                        <i class="fas fa-file-alt me-1"></i> <!-- Font Awesome --> Nuevo Evento
                    </a>
                    <a href="{{ route('eventos.reporte') }}" class="btn btn-orange btn-sm">
                        <i class="fas fa-download me-1"></i> <!-- Font Awesome --> Exportar PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Cuerpo -->
        <div class="p-4">
            <div class="table-responsive">
                <table class="event-table">
                    <thead>
                        <tr>
                            <th class="text-start">Tipo</th>
                            <th class="text-start">Descripción</th>
                            <th class="text-center">Fecha Inicio</th>
                            <th class="text-center">Fecha Fin</th>
                            <th class="text-center">Hora</th>
                            <th class="text-center">Cupo</th>
                            <th class="text-start">Encargado</th>
                            <th class="text-center">Sucursal</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $evento)
                        <tr>
                            <td class="text-start">
                                <span class="badge badge-primary-event badge-event">{{ $evento->tipo }}</span>
                            </td>
                            <td class="text-start">{{ Str::limit($evento->descripcion, 50) }}</td>
                            <td class="text-center event-date">{{ date('d/m/Y', strtotime($evento->fecha_inicio)) }}</td>
                            <td class="text-center event-date">{{ date('d/m/Y', strtotime($evento->fecha_fin)) }}</td>
                            <td class="text-center">
                                {{ date('H:i', strtotime($evento->hora_inicio)) }} - {{ date('H:i', strtotime($evento->hora_fin)) }}
                            </td>
                            <td class="text-center">{{ $evento->cupo }}</td>
                            <td class="text-start">
                                {{ $evento->encargado }}<br>
                                <small class="text-muted">{{ $evento->telefono }}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-primary-event badge-event">{{ $evento->sucursal->nombre }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('administrador.eventos.edit', $evento->id_evento) }}"
                                        class="btn btn-sm btn-outline-event"
                                        title="Editar"
                                        data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                        class="btn btn-sm btn-primary-event"
                                        title="Eliminar"
                                        data-bs-toggle="tooltip"
                                        onclick="confirmDelete('{{ $evento->id_evento }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $evento->id_evento }}"
                                        action="{{ route('administrador.eventos.destroy', $evento->id_evento) }}"
                                        method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="pagination-event">
                    {{ $eventos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Mostrar alerta
    window.addEventListener('DOMContentLoaded', (event) => {
        const alertElement = document.getElementById('custom-alert');

        if (alertElement) {
            alertElement.classList.add('show');

            setTimeout(() => {
                alertElement.classList.remove('show');
            }, 5000);
        }
    });

    // Confirmación para eliminar
    function confirmDelete(eventoId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#FF7F32',
            cancelButtonColor: '#2C3E50',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + eventoId).submit();
            }
        });
    }

    // Tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endsection