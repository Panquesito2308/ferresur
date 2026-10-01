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
            text-transform: uppercase;
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

            .d-md-flex {
                flex-direction: column;
            }

            .me-md-2 {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
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
            <h1>Crear empleado</h1>
            <p>Complete el formulario para registrar a un nuevo empleado.</p>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('administrador.empleados.store') }}" class="form-section" id="empleadoForm">
                @csrf

                <h2 class="form-title">Información personal</h2>

                <!-- Datos personales -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            placeholder="Nombre del empleado"
                            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                            title="Solo letras permitidas"
                            oninput="capitalizeWords(this)"
                            required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control"
                            placeholder="Apellidos del empleado"
                            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                            title="Solo letras permitidas"
                            oninput="capitalizeWords(this)"
                            required>
                    </div>
                </div>

                <!-- Fecha de nacimiento y edad -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                            class="form-control"
                            max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" name="edad" id="edad" class="form-control" readonly>
                    </div>
                </div>

                <h2 class="form-title">Información laboral</h2>

                <!-- Número de unidad -->
                <div class="mb-4">
                    <label for="numero_unidad" class="form-label">Número de unidad</label>
                    <input type="text" name="numero_unidad" id="numero_unidad" class="form-control"
                        placeholder="Número de unidad del empleado"
                        maxlength="11">
                </div>

                <!-- Sucursal -->
                <div class="mb-4">
                    <label for="id_sucursal" class="form-label">Sucursal</label>
                    <select name="id_sucursal" id="id_sucursal" class="form-select" required>
                        <option value="" selected disabled>Seleccione una sucursal.</option>
                        @foreach ($sucursales as $sucursal)
                        <option value="{{ $sucursal->id_sucursal }}">{{ $sucursal->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="reset" class="btn btn-secondary me-md-2">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-person-plus me-1"></i> Guardar empleado
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Scripts -->
    <script>
        // Función para poner en mayúscula cada palabra
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
                this.setCustomValidity('El empleado debe tener, al menos, 18 años.');
            } else {
                this.setCustomValidity('');
            }
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