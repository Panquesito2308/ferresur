@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>

<body>
    <div class="hero-section">
        <video class="background-video" autoplay loop muted playsinline>
            <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
            Tu navegador no soporta el formato de video.
        </video>
        <div class="content">
            <h1>REGISTRO</h1>
        </div>
    </div>
    <section class="conten">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card custom-card">
                        <div class="card-body">
                            <h3 class="text-center mb-4">Registro de Usuario</h3>
                            <form method="POST" action="{{ route('register') }}" id="registerForm">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control"
                                            placeholder="Nombre del cliente"
                                            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                                            title="Solo letras permitidas"
                                            oninput="capitalizeWords(this)"
                                            required
                                            maxlength="50">
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="apellidos" class="form-label">Apellidos</label>
                                        <input type="text" name="apellidos" id="apellidos" class="form-control"
                                            placeholder="Apellidos del cliente"
                                            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                                            title="Solo letras permitidas"
                                            oninput="capitalizeWords(this)"
                                            required
                                            maxlength="50">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="tel" name="telefono" id="telefono" class="form-control"
                                            placeholder="Número de teléfono" required maxlength="10">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control"
                                            placeholder="Dirección completa" required maxlength="100">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="ciudad" class="form-label">Ciudad</label>
                                        <input type="text" name="ciudad" id="ciudad" class="form-control"
                                            placeholder="Ciudad" required maxlength="20">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="estado" class="form-label">Estado</label>
                                        <input type="text" name="estado" id="estado" class="form-control"
                                            placeholder="Estado" required maxlength="20">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="codigo_postal" class="form-label">Código Postal</label>
                                        <input type="text" name="codigo_postal" id="codigo_postal" class="form-control"
                                            placeholder="Código Postal" required maxlength="6">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                            class="form-control"
                                            max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edad" class="form-label">Edad</label>
                                        <input type="number" name="edad" id="edad" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label">Nombre de Usuario</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            placeholder="Nombre de usuario" required maxlength="10">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 position-relative">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Contraseña" required minlength="8" maxlength="10">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                    <i class="bi bi-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 position-relative">
                                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control" placeholder="Confirmar contraseña" required minlength="8" maxlength="10">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                                    <i class="bi bi-eye-slash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Registrarse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Función para capitalizar cada palabra
        function capitalizeWords(input) {
            const startPos = input.selectionStart;
            const endPos = input.selectionEnd;
            const originalValue = input.value;

            // Convertir todo a minúsculas primero y luego capitalizar
            input.value = originalValue.toLowerCase().replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });

            // Restaurar posición del cursor
            input.setSelectionRange(startPos, endPos);
        }

        // Cálculo de edad automático
        document.getElementById('fecha_nacimiento').addEventListener('change', function() {
            const fechaNacimiento = new Date(this.value);
            const fechaActual = new Date();

            let edad = fechaActual.getFullYear() - fechaNacimiento.getFullYear();
            const mes = fechaActual.getMonth() - fechaNacimiento.getMonth();

            if (mes < 0 || (mes === 0 && fechaActual.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }

            document.getElementById('edad').value = edad;

            // Validación de edad mínima
            if (edad < 18) {
                this.setCustomValidity('Debes tener al menos 18 años para registrarte.');
            } else {
                this.setCustomValidity('');
            }
        });

        // Mostrar/ocultar contraseña
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPassword = document.getElementById('password_confirmation');
            const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPassword.setAttribute('type', type);
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });

        // Validación del formulario
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        }, false);
    </script>

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

        .custom-card h3 {
            color: #333;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        /* Campos de texto */
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

        .custom-card .btn-outline-secondary {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }

        .custom-card .btn-outline-secondary:hover {
            background-color: #e2e6ea;
        }

        .custom-card .input-group-append button {
            border-radius: 0 6px 6px 0;
            height: 45px;
        }

        /* Estilos de los mensajes de error */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
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