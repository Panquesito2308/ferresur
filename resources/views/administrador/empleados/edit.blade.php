@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <style>
        :root {
            --color-primary: #FF7F32;
            --color-secondary: #2C3E50;
            --color-light: #F8F9FA;
            --color-dark: #212529;
        }

        .conten {
            background-color: var(--color-light);
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            animation: fadeIn 0.5s ease;
        }

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            margin-bottom: 2rem;
        }

        .form-title {
            color: var(--color-secondary);
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
            background: var(--color-primary);
        }

        .form-label {
            color: var(--color-secondary);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 0.25rem rgba(255, 127, 50, 0.25);
        }

        .btn {
            border-radius: 8px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary {
            background-color: var(--color-primary);
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

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 8px;
        }

        .password-section {
            display: none;
            margin-top: 1rem;
            padding: 1rem;
            background-color: var(--color-light);
            border-radius: 8px;
            border-left: 4px solid var(--color-primary);
        }

        .password-section.visible {
            display: block;
            animation: slideDown 0.3s ease;
        }

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

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<div class="hero-section">
    <video class="background-video" autoplay loop muted playsinline>
        <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
        Tu navegador no soporta el formato de video.
    </video>
    <div class="content">
        <h1>EDITAR EMPLEADO</h1>
        <p>Actualice la información del empleado</p>
    </div>
</div>

<section class="conten">
    <div class="container form-container">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Error en el formulario</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('administrador.empleados.update', $empleado->id_empleado) }}" method="POST" class="form-card needs-validation" novalidate>
            @csrf
            @method('PUT')

            <!-- Sección 1: Información Personal -->
            <h2 class="form-title"><i class="bi bi-person-lines-fill me-2"></i>Información Personal</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                        value="{{ old('nombre', $empleado->nombre) }}"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                        title="Solo letras permitidas"
                        oninput="capitalizeWords(this)"
                        maxlength="50"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control"
                        value="{{ old('apellidos', $empleado->apellidos) }}"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                        title="Solo letras permitidas"
                        oninput="capitalizeWords(this)"
                        maxlength="50"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                        value="{{ old('fecha_nacimiento', $empleado->fecha_nacimiento) }}"
                        max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" name="edad" id="edad" class="form-control"
                        value="{{ old('edad', $empleado->edad) }}" readonly>
                </div>
            </div>
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" name="telefono" id="telefono"
                class="form-control @error('telefono') is-invalid @enderror" placeholder="Número de teléfono (10 dígitos)"
                pattern="\d{10}"
                title="Debe contener exactamente 10 dígitos numéricos"
                maxlength="10"
                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                value="{{ old('telefono', $empleado->telefono) }}"
                required>
            <!-- Sección 2: Información Laboral -->
            <h2 class="form-title"><i class="bi bi-briefcase-fill me-2"></i>Información Laboral</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="numero_unidad" class="form-label">Número de Unidad</label>
                    <input type="text" name="numero_unidad" id="numero_unidad" class="form-control"
                        value="{{ old('numero_unidad', $empleado->numero_unidad) }}"
                        maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>

                <div class="col-md-6 mb-4">
                    <label for="id_sucursal" class="form-label">Sucursal</label>
                    <select name="id_sucursal" id="id_sucursal" class="form-select" required>
                        <option value="" disabled>Seleccione una sucursal</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}"
                            {{ old('id_sucursal', $empleado->id_sucursal) == $sucursal->id_sucursal ? 'selected' : '' }}>
                            {{ $sucursal->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Sección 3: Credenciales de Acceso -->
            <h2 class="form-title"><i class="bi bi-shield-lock me-2"></i>Credenciales de Acceso</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="{{ old('username', $empleado->user->username) }}"
                        maxlength="10"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="role" class="form-label">Rol</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="administrador" {{ old('role', $empleado->user->role) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="empleado" {{ old('role', $empleado->user->role) == 'empleado' ? 'selected' : '' }}>Empleado</option>
                    </select>
                </div>
            </div>

            <!-- Sección de Cambio de Contraseña (oculta inicialmente) -->
            <div class="row">
                <div class="col-12 mb-3">
                    <button type="button" id="togglePasswordBtn" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-key me-1"></i> Cambiar Contraseña
                    </button>
                </div>
            </div>

            <div id="passwordSection" class="password-section">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control"
                            minlength="8" maxlength="10"
                            placeholder="Ingrese nueva contraseña">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                            minlength="8" maxlength="10"
                            placeholder="Confirme la nueva contraseña">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i> Actualizar Empleado
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    // Función para capitalizar nombres
    function capitalizeWords(input) {
        const cursorPos = input.selectionStart;
        input.value = input.value.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
        input.setSelectionRange(cursorPos, cursorPos);
    }

    // Calcular edad automáticamente
    document.getElementById('fecha_nacimiento').addEventListener('change', function() {
        const birthDate = new Date(this.value);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();

        if (today.getMonth() < birthDate.getMonth() ||
            (today.getMonth() === birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
            age--;
        }

        document.getElementById('edad').value = age;
    });

    // Toggle para mostrar/ocultar sección de contraseña
    document.getElementById('togglePasswordBtn').addEventListener('click', function() {
        const passwordSection = document.getElementById('passwordSection');
        passwordSection.classList.toggle('visible');

        // Cambiar ícono y texto del botón
        const icon = this.querySelector('i');
        if (passwordSection.classList.contains('visible')) {
            icon.classList.remove('bi-key');
            icon.classList.add('bi-key-fill');
            this.textContent = ' Ocultar Cambio de Contraseña';
        } else {
            icon.classList.remove('bi-key-fill');
            icon.classList.add('bi-key');
            this.textContent = ' Cambiar Contraseña';
        }
        this.prepend(icon);
    });

    // Validación del formulario
    document.querySelector('.needs-validation').addEventListener('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        this.classList.add('was-validated');
    });

    // Calcular edad al cargar si ya hay fecha
    window.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('fecha_nacimiento').value) {
            document.getElementById('fecha_nacimiento').dispatchEvent(new Event('change'));
        }
    });
    // Validación específica para teléfono
    document.getElementById('telefono').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });

    // Validación al enviar el formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const telefono = document.getElementById('telefono');
        if (telefono.value.length !== 10) {
            e.preventDefault();
            telefono.classList.add('is-invalid');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = 'El teléfono debe tener exactamente 10 dígitos';
            telefono.parentNode.appendChild(errorDiv);
        }
    });
</script>
@endsection