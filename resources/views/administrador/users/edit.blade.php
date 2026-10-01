@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">

    <style>
        /* Estilo para la sección de contenido */
        .conten {
            background-color: #f8f9fa;
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        /* Contenedor del formulario */
        .event-form-container {
            max-width: 900px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Estilos de la tarjeta */
        .form-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        /* Título del formulario */
        .form-title {
            color: #2C3E50;
            font-weight: 700;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .form-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: #FF7F32;
        }

        /* Campos de formulario */
        .form-label {
            color: #333;
            font-weight: 500;
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s;
            height: 45px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #FF7F32;
            box-shadow: 0 0 0 0.25rem rgba(255, 127, 50, 0.25);
        }

        /* Botones */
        .btn {
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }

        .btn-primary {
            background-color: #FF7F32;
            border: none;
        }

        .btn-primary:hover {
            background-color: #E06A1B;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(224, 106, 27, 0.3);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        .btn-toggle {
            background-color: transparent;
            border: 1px solid #FF7F32;
            color: #FF7F32;
            padding: 8px 16px;
            font-size: 0.9rem;
        }

        .btn-toggle:hover {
            background-color: #FF7F32;
            color: white;
        }

        /* Password fields container */
        .password-fields {
            display: none;
            transition: all 0.3s ease;
        }

        /* Alertas */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 8px;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-section {
                padding: 1.5rem;
            }

            .row>div {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<div class="hero-section">
    <!-- Video de fondo -->
    <video class="background-video" autoplay loop muted playsinline>
        <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
        Tu navegador no soporta el formato de video.
    </video>
    <!-- Contenido -->
    <div class="content">
        <h1>EDITAR USUARIO</h1>
        <p>Actualice la información del usuario</p>
    </div>
</div>

<section class="conten">
    <div class="container event-form-container">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Error en el formulario</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('administrador.users.update', $user->id) }}" method="POST" class="form-section needs-validation" novalidate>
            @csrf
            @method('PUT')

            <h2 class="form-title">Información Básica</h2>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="id_empleado" class="form-label">Empleado</label>
                    <select name="id_empleado" id="id_empleado" class="form-select" required>
                        <option value="" disabled>Seleccione un empleado</option>
                        @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id_empleado }}"
                            {{ old('id_empleado', $user->id_empleado) == $empleado->id_empleado ? 'selected' : '' }}>
                            {{ $empleado->nombre }} {{ $empleado->apellidos }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="administrador" {{ old('role', $user->role) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="empleado" {{ old('role', $user->role) == 'empleado' ? 'selected' : '' }}>Empleado</option>
                    </select>
                </div>

                <div class="col-md-6 mb-4 d-flex align-items-end">
                    <button type="button" id="togglePassword" class="btn btn-toggle">
                        <i class="bi bi-key me-1"></i> Cambiar Contraseña
                    </button>
                </div>
            </div>

            <div id="passwordFields" class="password-fields">
                <h2 class="form-title mt-4">Cambiar Contraseña</h2>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <small class="text-muted">Mínimo 8 caracteres</small>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('administrador.users.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    // Toggle password fields
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordFields = document.getElementById('passwordFields');
        const isVisible = passwordFields.style.display === 'block';

        passwordFields.style.display = isVisible ? 'none' : 'block';
        this.innerHTML = isVisible ?
            '<i class="bi bi-key me-1"></i> Cambiar Contraseña' :
            '<i class="bi bi-x-circle me-1"></i> Ocultar Cambio';

        // Reset fields when hiding
        if (isVisible) {
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        }
    });

    // Form validation
    document.querySelector('.needs-validation').addEventListener('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        this.classList.add('was-validated');
    }, false);
</script>
@endsection