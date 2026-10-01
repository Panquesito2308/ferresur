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
            margin-bottom: 2rem;
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

        .alert-danger-event {
            background-color: rgba(220, 53, 69, 0.1);
            border-left-color: var(--color-danger);
            color: #721c24;
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
            background-color: var(--color-primary) !important;
            border: 1px solid #E06A1B;
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

        .btn-orange:hover {
            background-color: #E06A1B;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            color: white;
        }

        .btn-orange i {
            margin-right: 5px;
            font-size: 0.9em;
        }

        .btn-orange-outline {
            background-color: transparent;
            border: 1px solid var(--color-primary);
            color: var(--color-primary) !important;
        }

        .btn-orange-outline:hover {
            background-color: var(--color-primary);
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

        /* Estilos específicos para clientes */
        .client-card {
            background-color: var(--color-white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .client-title {
            color: var(--color-secondary);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
            margin-bottom: 1rem;
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

    @if (session('error'))
    <div class="alert-event alert-danger-event" id="custom-alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
    </div>
    @endif

    <div class="event-container">
        <div class="event-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fs-4 fw-bold"><i class="bi bi-shop me-2"></i>Gestión de Sucursales</h2>
                <div>
                    <a href="{{ route('administrador.sucursales.create') }}" class="btn btn-orange btn-sm">
                        <i class="fas fa-plus me-1"></i> Nueva Sucursal
                    </a>
                </div>
            </div>
        </div>

        <div class="p-4">
            <div class="table-responsive">
                <table class="event-table">
                    <thead>
                        <tr>
                            <th class="text-start">Nombre</th>
                            <th class="text-start">Dirección</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sucursales as $sucursal)
                        <tr>
                            <td class="text-start">{{ $sucursal->nombre }}</td>
                            <td class="text-start">{{ $sucursal->direccion }}</td>
                            <td class="text-center">{{ $sucursal->telefono }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('administrador.sucursales.edit', $sucursal->id_sucursal) }}"
                                        class="btn btn-sm btn-outline-event"
                                        title="Editar"
                                        data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-danger-event"
                                        title="Eliminar"
                                        data-bs-toggle="tooltip"
                                        onclick="confirmDelete('{{ $sucursal->id_sucursal }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $sucursal->id_sucursal }}"
                                        action="{{ route('administrador.sucursales.destroy', $sucursal->id_sucursal) }}"
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

            >
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
            }, 3000); // La alerta desaparece después de 3 segundos
        }
    });

    // Confirmar eliminación
    function confirmDelete(sucursalId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + sucursalId).submit();
            }
        });
    }
</script>
@endsection