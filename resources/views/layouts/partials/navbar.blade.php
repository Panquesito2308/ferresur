<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ferresur</title>
    <!-- Bootstrap CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Estilos personalizados - Color naranja (#FF7F32) */
        :root {
            --primary-color: #FF7F32;
            --primary-hover: #E06A1B;
            --primary-light: rgba(255, 127, 50, 0.1);
        }

        /* Estilo para enlaces activos */
        .nav-link.active {
            color: var(--primary-color) !important;
            font-weight: 600;
            position: relative;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 15px;
            right: 15px;
            height: 2px;
            background-color: var(--primary-color);
            animation: underline-grow 0.3s ease-out;
            transform-origin: left center;
        }

        /* Efecto hover */
        .nav-link:not(.active):hover {
            color: var(--primary-color) !important;
            background-color: var(--primary-light);
        }

        /* Dropdown */
        .dropdown-item.active,
        .dropdown-item:active {
            background-color: var(--primary-light) !important;
            color: var(--primary-color) !important;
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
        }

        /* Botón de logout */
        .dropdown-item[onclick] {
            color: #dc3545;
        }

        .dropdown-item[onclick]:hover {
            background-color: rgba(220, 53, 69, 0.1);
        }

        /* Animaciones */
        @keyframes underline-grow {
            from {
                transform: scaleX(0);
                opacity: 0;
            }

            to {
                transform: scaleX(1);
                opacity: 1;
            }
        }

        /* Corrección específica para eventos/historial */
        .nav-link[href*="historial"].active {
            color: var(--primary-color) !important;
        }

        .nav-link[href*="eventos"]:not([href*="historial"]).active {
            color: var(--primary-color) !important;
        }

        /* Estilo para el nombre de usuario */
        .user-name {
            display: inline-flex;
            align-items: center;
        }

        .user-name i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .dropdown-toggle:hover .user-name i {
            transform: rotate(15deg);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo_comp.png') }}" alt="Logo" width="220">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- Mostrar solo si el usuario NO está autenticado --}}
                    @guest('web')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('nuestra_empresa') ? 'active' : '' }}" href="/nuestra_empresa">Nuestra Empresa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sucursales') ? 'active' : '' }}" href="/sucursales">Sucursales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ferresur_en_accion') ? 'active' : '' }}" href="/ferresur_en_accion">Ferresur En Acción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ventas_mayoreo') ? 'active' : '' }}" href="/ventas_mayoreo">Ventas Mayoreo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}" href="/contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Registrarse</a>
                    </li>
                    @endguest

                    {{-- Opciones solo para el Administrador --}}
                    @auth('web')
                    @if (Auth::user()->role === 'administrador')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('administrador.dashboard') ? 'active' : '' }}" href="/administrador/dashboard">Principal Administrador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('administrador.empleados.*') ? 'active' : '' }}" href="{{ route('administrador.empleados.index') }}">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('administrador.clientes.*') ? 'active' : '' }}" href="{{ route('administrador.clientes.index') }}">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('administrador.sucursales.*') ? 'active' : '' }}" href="{{ route('administrador.sucursales.index') }}">Sucursales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('administrador.eventos.index') ? 'active' : '' }}"
                            href="{{ route('administrador.eventos.index') }}">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('administrador.eventos.historial') ? 'active' : '' }}"
                            href="{{ route('administrador.eventos.historial') }}">Historial de Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('administrador.download') ? 'active' : '' }}" href="/administrador/download">Descargar App</a>
                    </li>
                    @endif

                    {{-- Opciones solo para Empleados --}}
                    @if (Auth::user()->role === 'empleado')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('empleado.dashboard') ? 'active' : '' }}" href="/empleado/dashboard">Principal Empleado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('empleado.eventos.index') ? 'active' : '' }}"
                            href="{{ route('empleado.eventos.index') }}">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('empleado.eventos.historial') ? 'active' : '' }}"
                            href="{{ route('empleado.eventos.historial') }}">Historial de eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('empleado.download') ? 'active' : '' }}" href="/empleado/download">Descargar App</a>
                    </li>
                    @endif

                    {{-- Opciones solo para Clientes --}}
                    @if (Auth::user()->role === 'cliente')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('nuestra_empresa') ? 'active' : '' }}" href="/nuestra_empresa">Nuestra Empresa</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sucursales') ? 'active' : '' }}" href="/sucursales">Sucursales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ferresur_en_accion') ? 'active' : '' }}" href="/ferresur_en_accion">Ferresur En Acción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('ventas_mayoreo') ? 'active' : '' }}" href="/ventas_mayoreo">Ventas Mayoreo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}" href="/contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cliente.eventos.index') ? 'active' : '' }}"
                            href="{{ route('cliente.eventos.index') }}">Eventos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cliente.eventos.historial') ? 'active' : '' }}"
                            href="{{ route('cliente.eventos.historial') }}">Historial de eventos</a>
                    </li>
                    @endif
                    @endauth
                </ul>

                {{-- Menú de usuario --}}
                @auth
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="user-name">
                                @if (Auth::user()->role === 'cliente')
                                {{ Auth::user()->cliente->nombre }} {{ Auth::user()->cliente->apellidos }} ({{ Auth::user()->role }})
                                @else
                                {{ Auth::user()->empleado->nombre }} {{ Auth::user()->empleado->apellidos }} ({{ Auth::user()->role }})
                                @endif
                                <i class="fas fa-user"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->role === 'administrador')
                            <li>
                                <form action="{{ route('backup.create') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-database me-2"></i>Respaldar Base de Datos
                                    </button>
                                </form>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        let backupMessage = "{{ session('backup_message') }}";
                                        if (backupMessage) {
                                            Swal.fire({
                                                title: 'Backup Generado En Public/Backups',
                                                text: backupMessage,
                                                icon: 'success',
                                                confirmButtonColor: '#FF7F32'
                                            });
                                        }
                                    });
                                </script>

                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @endif

                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit" onclick="event.preventDefault(); confirmLogout()">
                                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Función para confirmar logout
        function confirmLogout() {
            Swal.fire({
                title: '¿Cerrar sesión?',
                text: "¿Estás seguro de que deseas salir?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#FF7F32',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'animate__animated animate__bounceIn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        }

        // Corrección para la activación de enlaces
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;

            // Desactivar todos los enlaces primero
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });

            // Activar enlaces basados en la ruta exacta
            document.querySelectorAll('.nav-link').forEach(link => {
                const linkPath = new URL(link.href).pathname;

                // Para rutas con parámetros
                if (linkPath === currentPath ||
                    (currentPath.startsWith(linkPath) && linkPath !== '/')) {
                    link.classList.add('active');

                    // Si es un dropdown-item, activar también el padre
                    if (link.classList.contains('dropdown-item')) {
                        const dropdownToggle = link.closest('.dropdown-menu').previousElementSibling;
                        if (dropdownToggle) {
                            dropdownToggle.classList.add('active');
                        }
                    }
                }
            });

            // Manejo especial para eventos/historial
            if (currentPath.includes('historial')) {
                document.querySelectorAll('.nav-link[href*="eventos"]:not([href*="historial"])').forEach(link => {
                    link.classList.remove('active');
                });
            }

            // Agregar animación al enlace activo
            const activeLinks = document.querySelectorAll('.nav-link.active');
            activeLinks.forEach(link => {
                link.style.animation = 'underline-grow 0.3s ease-out';
                setTimeout(() => {
                    link.style.animation = '';
                }, 300);
            });
        });
    </script>
</body>

</html>