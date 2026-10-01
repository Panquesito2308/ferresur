@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        /* Estilos consistentes */
        .conten {
            background-color: #f8f9fa;
            min-height: calc(100vh - 200px);
        }

        .custom-card {
            max-width: 800px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            border: none;
        }

        .section-title {
            color: #ff7f32;
            font-weight: 600;
            border-bottom: 2px solid #ff7f32;
            padding-bottom: 8px;
            display: inline-block;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #ff7f32;
            box-shadow: 0 0 0 0.25rem rgba(255, 127, 50, 0.25);
        }

        .btn-primary {
            background-color: #ff7f32;
            border-color: #ff7f32;
        }

        .btn-primary:hover {
            background-color: #e06a1b;
            border-color: #e06a1b;
        }

        .alert-danger {
            border-left: 4px solid #dc3545;
        }
    </style>
</head>

<body>
    <div class="hero-section">
        <video class="background-video" autoplay loop muted playsinline>
            <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
            Tu navegador no soporta el formato de video.
        </video>
        <div class="content">
            <h1>CREAR NUEVO EMPLEADO</h1>
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
                            <form method="POST" action="{{ route('administrador.empleados.store') }}" id="empleadoForm">
                                @csrf

                                <!-- Sección 1: Datos Personales del Empleado -->
                                <h5 class="section-title mb-4">Datos Personales</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror"
                                            placeholder="Nombre del empleado"
                                            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                                            title="Solo letras permitidas"
                                            oninput="capitalizeWords(this)"
                                            value="{{ old('nombre') }}"
                                            maxlength="50"
                                            required>
                                        @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="apellidos" class="form-label">Apellidos</label>
                                        <input type="text" name="apellidos" id="apellidos" class="form-control @error('apellidos') is-invalid @enderror"
                                            placeholder="Apellidos del empleado"
                                            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                                            title="Solo letras permitidas"
                                            oninput="capitalizeWords(this)"
                                            value="{{ old('apellidos') }}"
                                            maxlength="50"
                                            required>
                                        @error('apellidos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="tel" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror"
                                            placeholder="Número de teléfono"
                                            maxlength="10"
                                            value="{{ old('telefono') }}"
                                            required>
                                        @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror"
                                            max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                                            value="{{ old('fecha_nacimiento') }}"
                                            required>
                                        <input type="hidden" name="edad" id="edad">
                                        @error('fecha_nacimiento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- Sección 3: Datos Laborales del Empleado -->
                                <h5 class="section-title mb-4 mt-4">Datos Laborales</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="id_sucursal" class="form-label">Sucursal</label>
                                        <select name="id_sucursal" id="id_sucursal" class="form-select @error('id_sucursal') is-invalid @enderror" required>
                                            <option value="">Seleccione una sucursal</option>
                                            @foreach($sucursales as $sucursal)
                                            <option value="{{ $sucursal->id_sucursal }}" {{ old('id_sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>
                                                {{ $sucursal->nombre }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_sucursal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="numero_unidad" class="form-label">Número de Unidad (opcional)</label>
                                        <input type="text" name="numero_unidad" id="numero_unidad" class="form-control @error('numero_unidad') is-invalid @enderror"
                                            placeholder="Número de unidad asignada"
                                            maxlength="11"
                                            value="{{ old('numero_unidad') }}">
                                        @error('numero_unidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Sección 4: Credenciales de Usuario (tabla usuarios) -->
                                <h5 class="section-title mb-4 mt-4">Credenciales de Acceso</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="username" class="form-label">Nombre de Usuario</label>
                                        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                                            placeholder="Nombre de usuario"
                                            value="{{ old('username') }}"
                                            maxlength="10"
                                            required>
                                        @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="role" class="form-label">Rol</label>
                                        <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                                            <option value="">Seleccione un rol</option>
                                            <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                                            <option value="empleado" {{ old('role') == 'empleado' ? 'selected' : '' }}>Empleado</option>
                                        </select>
                                        @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Contraseña"
                                            minlength="8"
                                            required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"
                                            placeholder="Confirmar contraseña"
                                            minlength="8"
                                            maxlength="10"

                                            required>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                                    <a href="{{ route('empleados.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar Empleado</button>
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

            input.value = originalValue.toLowerCase().replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });

            input.setSelectionRange(startPos, endPos);
        }

        // Calcular edad automáticamente
        document.getElementById('fecha_nacimiento').addEventListener('change', function() {
            const fechaNacimiento = new Date(this.value);
            const hoy = new Date();
            let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
            const mes = hoy.getMonth() - fechaNacimiento.getMonth();

            if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                edad--;
            }

            document.getElementById('edad').value = edad;
        });

        // Validación del formulario
        document.getElementById('empleadoForm').addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            this.classList.add('was-validated');
        }, false);
    </script>
</body>
@endsection