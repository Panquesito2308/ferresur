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
        }

        /* Estructura principal */
        .user-container {
            background-color: var(--color-white);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .user-header {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1.5rem;
            border-bottom: 3px solid var(--color-primary);
        }

        /* Tabla de usuarios */
        .user-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .user-table thead th {
            background-color: var(--color-secondary);
            color: var(--color-white);
            padding: 1rem;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .user-table tbody tr {
            transition: all 0.2s ease;
        }

        .user-table tbody tr:hover {
            background-color: rgba(255, 127, 50, 0.05);
        }

        .user-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        /* Botones y acciones */
        .btn-user {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary-user {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: var(--color-white);
        }

        .btn-primary-user:hover {
            background-color: #E06A1B;
            border-color: #E06A1B;
        }

        .btn-outline-user {
            border: 1px solid var(--color-primary);
            color: var(--color-primary);
            background-color: transparent;
        }

        .btn-outline-user:hover {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        /* Badges */
        .badge-user {
            padding: 0.35em 0.65em;
            font-size: 0.85em;
            font-weight: 500;
            border-radius: 4px;
        }

        .badge-primary-user {
            background-color: var(--color-primary);
            color: var(--color-white);
        }

        .badge-secondary-user {
            background-color: var(--color-light);
            color: var(--color-dark);
            border: 1px solid #dee2e6;
        }

        /* Alertas */
        .alert-user {
            border-left: 4px solid;
            border-radius: 4px;
        }

        .alert-success-user {
            background-color: rgba(40, 167, 69, 0.1);
            border-left-color: #28a745;
            color: #155724;
        }

        .alert-danger-user {
            background-color: rgba(220, 53, 69, 0.1);
            border-left-color: #dc3545;
            color: #721c24;
        }

        /* Paginación */
        .pagination-user .page-item.active .page-link {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }

        .pagination-user .page-link {
            color: var(--color-secondary);
            border: 1px solid #dee2e6;
        }

        .pagination-user .page-link:hover {
            background-color: var(--color-light);
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
    <!-- Alertas -->
    @if(session('success'))
    <div class="alert alert-success-user alert-user alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger-user alert-user alert-dismissible fade show mb-4" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Contenedor principal -->
    <div class="user-container">
        <!-- Encabezado -->
        <div class="user-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0 fs-4 fw-bold"><i class="bi bi-people-fill me-2"></i>Gestión de Usuarios</h2>
                <div>
                    <a href="{{ route('administrador.users.create') }}" class="btn btn-orange btn-sm">
                        <i class="fas fa-plus-circle me-1"></i> Nuevo Usuario
                    </a>
                </div>
            </div>
        </div>

        <!-- Cuerpo -->
        <div class="p-4">
            <div class="table-responsive">
                <table class="user-table">
                    <thead>
                        <tr>
                            <th class="text-start">Nombre de Usuario</th>
                            <th class="text-start">Empleado</th>
                            <th class="text-center">Rol</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td class="text-start">{{ $user->username }}</td>
                            <td class="text-start">
                                @if($user->empleado)
                                {{ $user->empleado->nombre }} {{ $user->empleado->apellidos }}
                                @else
                                <span class="badge badge-secondary-user badge-user">N/A</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge badge-primary-user badge-user">{{ $user->role }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('administrador.users.edit', $user->id) }}"
                                        class="btn btn-sm btn-outline-user"
                                        title="Editar"
                                        data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('administrador.users.destroy', $user->id) }}"
                                        method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-primary-user"
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
            @if($users->hasPages())
            <div class="d-flex justify-content-center mt-4">
                <div class="pagination-user">
                    {{ $users->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Confirmación para eliminar
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirmar eliminación',
                text: "¿Está seguro que desea eliminar este usuario? Esta acción no se puede deshacer.",
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
</script>
@endsection