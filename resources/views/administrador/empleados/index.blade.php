@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        /* Paleta de colores */
        :root {
            --color-primary: #FF7F32;
            --color-secondary: #2C3E50;
            --color-light: #F8F9FA;
            --color-dark: #212529;
            --color-white: #FFFFFF;
            --color-success: #28a745;
            --color-danger: #dc3545;
            --color-warning: #ffc107;
            --color-info: rgba(27, 29, 29, 0.64);
        }

        /* Estructura principal */
        .employee-container {
            background-color: var(--color-white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .employee-header {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1.5rem;
            border-bottom: 3px solid var(--color-primary);
        }

        /* Tabla de empleados */
        .employee-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .employee-table thead th {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .employee-table tbody tr {
            transition: all 0.2s ease;
        }

        .employee-table tbody tr:hover {
            background-color: rgba(255, 127, 50, 0.05);
        }

        .employee-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        /* Botones y acciones */
        .btn-employee {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary-employee {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary-employee:hover {
            background-color: #E06A1B;
            border-color: #E06A1B;
        }

        .btn-outline-employee {
            border: 1px solid var(--color-primary);
            color: var(--color-primary);
            background-color: transparent;
        }

        .btn-outline-employee:hover {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        /* Badges - Estilos corregidos */
        .badge-employee {
            padding: 0.35em 0.65em;
            font-size: 0.85em;
            font-weight: 500;
            border-radius: 4px;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }

        .badge-primary-employee {
            background-color: var(--color-primary);
            color: var(--color-white);
            border: 1px solid var(--color-primary);
        }

        .badge-secondary-employee {
            background-color: var(--color-light);
            color: var(--color-dark);
            border: 1px solid #dee2e6;
        }

        /* Estilos específicos para roles */
        .badge-role-administrador {
            background-color: var(--color-primary);
            color: white;
        }

        .badge-role-empleado {
            background-color: var(--color-info);
            color: white;
        }

        .badge-role-supervisor {
            background-color: var(--color-warning);
            color: var(--color-dark);
        }

        .badge-role-gerente {
            background-color: var(--color-success);
            color: white;
        }

        .badge-role-inactivo {
            background-color: var(--color-danger);
            color: white;
        }

        /* Alertas con animación */
        .alert-employee {
            border-left: 4px solid;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
            opacity: 0;
            transform: translateY(-100%);
            transition: all 0.5s ease-out;
        }

        .alert-employee.show {
            opacity: 1;
            transform: translateY(0);
        }

        .alert-employee.hide {
            opacity: 0;
            transform: translateY(-100%);
            max-height: 0;
            padding-top: 0;
            padding-bottom: 0;
            margin-bottom: 0;
            transition: all 0.5s ease-out;
        }

        .alert-success-employee {
            background-color: rgba(40, 167, 69, 0.1);
            border-left-color: var(--color-success);
            color: #155724;
        }

        .alert-danger-employee {
            background-color: rgba(220, 53, 69, 0.1);
            border-left-color: var(--color-danger);
            color: #721c24;
        }

        /* Paginación */
        .pagination-employee .page-item.active .page-link {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .pagination-employee .page-link {
            color: var(--color-secondary);
            border: 1px solid #dee2e6;
        }

        .pagination-employee .page-link:hover {
            background-color: var(--color-light);
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

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
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

        .btn-orange:hover i {
            animation: bounce 0.5s ease;
        }
    </style>
</head>

<div class="container py-4">
    <!-- Alertas con animación -->
    @if(session('success'))
    <div class="alert alert-success-employee alert-employee mb-4" role="alert" id="successAlert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger-employee alert-employee mb-4" role="alert" id="errorAlert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Contenedor principal -->
    <div class="employee-container">
        <!-- Encabezado -->
        <div class="employee-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fs-4 fw-bold"><i class="bi bi-people-fill me-2"></i>Gestión de Empleados</h2>
                <div>
                    <a href="{{ route('administrador.empleados.create') }}" class="btn btn-orange btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Nuevo Empleado
                    </a>
                    <a href="{{ route('empleados.reporte') }}" class="btn btn-orange btn-sm">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Exportar PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Cuerpo -->
        <div class="p-4">
            <div class="table-responsive">
                <table class="employee-table">
                    <thead>
                        <tr>
                            <th class="text-start">Nombre</th>
                            <th class="text-start">Apellidos</th>
                            <th class="text-center">Edad</th>
                            <th class="text-center">Fecha Nacimiento</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">N° Unidad</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Sucursal</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empleados as $empleado)
                        <tr>
                            <td class="text-start">{{ $empleado->nombre }}</td>
                            <td class="text-start">{{ $empleado->apellidos }}</td>
                            <td class="text-center">{{ $empleado->edad }}</td>
                            <td class="text-center">{{ date('d/m/Y', strtotime($empleado->fecha_nacimiento)) }}</td>
                            <td class="text-center">{{ $empleado->telefono }}</td>
                            <td class="text-center">{{ $empleado->numero_unidad ?? '-' }}</td>
                            <td class="text-center">
                                @if($empleado->user)
                                {{ $empleado->user->username }}
                                @else
                                <span class="badge-employee badge-secondary-employee">Sin usuario</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($empleado->user)
                                <span class="badge-employee badge-role-{{ strtolower($empleado->user->role) }}">
                                    {{ ucfirst($empleado->user->role) }}
                                </span>
                                @else
                                <span class="badge-employee badge-secondary-employee">Sin rol</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($empleado->sucursal)
                                <span class="badge-employee badge-primary-employee">{{ $empleado->sucursal->nombre }}</span>
                                @else
                                <span class="badge-employee badge-secondary-employee">Sin asignar</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('empleados.edit', $empleado->id_empleado) }}"
                                        class="btn btn-sm btn-outline-employee"
                                        title="Editar"
                                        data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('administrador.empleados.destroy', $empleado->id_empleado) }}"
                                        method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-primary-employee"
                                            title="Eliminar"
                                            data-bs-toggle="tooltip">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                <div class="pagination-employee">
                    {{ $empleados->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Animación para las alertas
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar alertas con animación
        const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');

        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('show');

                // Ocultar después de 5 segundos
                setTimeout(() => {
                    successAlert.classList.remove('show');
                    successAlert.classList.add('hide');

                    // Eliminar completamente después de la animación
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);
                }, 5000);
            }, 100);
        }

        if (errorAlert) {
            setTimeout(() => {
                errorAlert.classList.add('show');

                // Ocultar después de 5 segundos
                setTimeout(() => {
                    errorAlert.classList.remove('show');
                    errorAlert.classList.add('hide');

                    // Eliminar completamente después de la animación
                    setTimeout(() => {
                        errorAlert.remove();
                    }, 500);
                }, 5000);
            }, 100);
        }

        // Cerrar manualmente
        document.querySelectorAll('.btn-close').forEach(btn => {
            btn.addEventListener('click', function() {
                const alert = this.closest('.alert-employee');
                alert.classList.remove('show');
                alert.classList.add('hide');

                setTimeout(() => {
                    alert.remove();
                }, 500);
            });
        });

        // Confirmación para eliminar
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Confirmar eliminación',
                    text: "¿Está seguro que desea eliminar este empleado? Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#FF7F32',
                    cancelButtonColor: '#2C3E50',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });

        // Tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection