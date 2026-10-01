@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="hero-section">
        <!-- Video de fondo -->
        <video class="background-video" autoplay loop muted playsinline>
            <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
            Tu navegador no soporta el formato de video.
        </video>
        <!-- Contenido -->
        <div class="content">
            <h1>CREAR USUARIO</h1>
        </div>
    </div>
    <section class="conten">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if ($empleados->isEmpty())
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        No hay empleados disponibles para crear cuentas de usuario.
                    </div>
                    @else
                    <div class="card custom-card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('administrador.users.store') }}" id="userForm">
                                @csrf

                                <!-- Nombre de Usuario -->
                                <div class="mb-3">
                                    <label for="username" class="form-label">Nombre de Usuario</label>
                                    <input type="text" name="username" id="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Máximo 10 caracteres"
                                        maxlength="10"
                                        pattern="[a-zA-Z0-9]+"
                                        title="Solo letras y números, sin espacios"
                                        value="{{ old('username') }}"
                                        required>
                                    @error('username')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Selección de Empleado -->
                                <div class="mb-3">
                                    <label for="id_empleado" class="form-label">Empleado</label>
                                    <select name="id_empleado" id="id_empleado"
                                        class="form-select @error('id_empleado') is-invalid @enderror" required>
                                        <option value="" disabled selected>Seleccione un empleado</option>
                                        @foreach ($empleados as $empleado)
                                        <option value="{{ $empleado->id_empleado }}" {{ old('id_empleado') == $empleado->id_empleado ? 'selected' : '' }}>
                                            {{ $empleado->nombre }} {{ $empleado->apellidos }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_empleado')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Rol del Usuario -->
                                <div class="mb-3">
                                    <label for="role" class="form-label">Rol</label>
                                    <select name="role" id="role"
                                        class="form-select @error('role') is-invalid @enderror" required>
                                        <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                        <option value="empleado" {{ old('role') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                                    </select>
                                    @error('role')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Contraseña -->
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Máximo 8 caracteres"
                                            maxlength="8"
                                            required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Confirmar Contraseña -->
                                <div class="mb-4 position-relative">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Confirmar contraseña"
                                            maxlength="8"
                                            required>
                                        <button class="btn btn-outline-secondary toggle-password" type="button">
                                            <i class="bi bi-eye-slash"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('administrador.users.index') }}" class="btn btn-secondary me-md-2">
                                        <i class="bi bi-x-circle me-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Crear Usuario
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script>
        // Toggle para mostrar/ocultar contraseña
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');

                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);

                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        });

        // Validación del formulario
        document.getElementById('userForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
                return false;
            }
            return true;
        });
    </script>

    <!-- Estilos consistentes -->
    <style>
        /* Estilo para la sección de contenido */
        .conten {
            background-color: #f8f9fa;
            min-height: calc(100vh - 200px);
        }

        /* Estilos de la tarjeta */
        .custom-card {
            max-width: 800px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            border: none;
        }

        /* Campos de formulario */
        .custom-card .form-label {
            color: #333;
            font-weight: 500;
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
        }

        .custom-card .form-control,
        .custom-card .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s;
            height: 45px;
        }

        .custom-card .form-control:focus,
        .custom-card .form-select:focus {
            border-color: #ff7f32;
            box-shadow: 0 0 0 0.25rem rgba(255, 127, 50, 0.25);
        }

        /* Grupo de input para contraseña */
        .input-group {
            position: relative;
        }

        .input-group .btn-outline-secondary {
            border-color: #ddd;
            background-color: #f8f9fa;
            height: 45px;
            border-left: none;
        }

        .input-group .btn-outline-secondary:hover {
            background-color: #e9ecef;
        }

        /* Botones */
        .custom-card .btn {
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .custom-card .btn-primary {
            background-color: #ff7f32;
            border: none;
        }

        .custom-card .btn-primary:hover {
            background-color: #e06a1b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(224, 106, 27, 0.3);
        }

        .custom-card .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .custom-card .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-2px);
        }

        /* Mensajes de error */
        .invalid-feedback {
            display: block;
            margin-top: 0.25rem;
            color: #dc3545;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        /* Alertas */
        .alert {
            border-radius: 8px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .custom-card {
                padding: 1.5rem;
            }

            .d-md-flex {
                flex-direction: column;
            }

            .me-md-2 {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</body>
@endsection