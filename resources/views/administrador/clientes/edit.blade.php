@extends('layouts.app-master')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
            border-bottom: 3px solid #FF7F32;
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

        /* Estilos para campos inválidos */
        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
            display: none;
        }

        .was-validated .form-control:invalid~.invalid-feedback,
        .was-validated .form-control:invalid~.invalid-tooltip,
        .form-control.is-invalid~.invalid-feedback,
        .form-control.is-invalid~.invalid-tooltip {
            display: block;
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

        /* Alertas */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 8px;
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }

        .alert-danger.show {
            opacity: 1;
            transform: translateY(0);
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

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .shake {
            animation: shake 0.5s;
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
        <h1>EDITAR CLIENTE</h1>
        <p>Actualice la información del cliente.</p>
    </div>
</div>

<section class="conten">
    <div class="container event-form-container">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" id="formErrorsAlert" role="alert">
            <h5 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i> Error en el formulario</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" id="successAlert" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('administrador.clientes.update', $cliente->id_cliente) }}" method="POST" class="form-section needs-validation" novalidate>
            @csrf
            @method('PUT')

            <h2 class="form-title">Información Personal</h2>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="{{ old('username', $cliente->usuario->username) }}"
                        maxlength="10"
                        pattern="[a-zA-Z0-9]+"
                        title="Solo letras y números permitidos (sin espacios)"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese un nombre de usuario válido (solo letras y números, máximo 10 caracteres).
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                        value="{{ old('nombre', $cliente->nombre) }}"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                        title="Solo letras permitidas"
                        oninput="capitalizeWords(this)"
                        maxlength="50"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese un nombre válido (solo letras).
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control"
                        value="{{ old('apellidos', $cliente->apellidos) }}"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                        title="Solo letras permitidas"
                        oninput="capitalizeWords(this)"
                        maxlength="50"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese apellidos válidos (solo letras).
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" id="telefono" name="telefono"
                        value="{{ old('telefono', $cliente->telefono) }}"
                        class="form-control"
                        placeholder="Número de teléfono (10 dígitos)"
                        pattern="\d{10}"
                        title="Debe contener exactamente 10 dígitos numéricos"
                        maxlength="10"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese un número de teléfono válido (10 dígitos).
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion"
                        value="{{ old('direccion', $cliente->direccion) }}"
                        minlength="10"
                        maxlength="100"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese una dirección válida (entre 10 y 100 caracteres).
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="ciudad" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad"
                        value="{{ old('ciudad', $cliente->ciudad) }}"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                        title="Solo letras permitidas"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese una ciudad válida (solo letras).
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado"
                        value="{{ old('estado', $cliente->estado) }}"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+"
                        title="Solo letras permitidas"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese un estado válido (solo letras).
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <label for="codigo_postal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal"
                        value="{{ old('codigo_postal', $cliente->codigo_postal) }}"
                        pattern="\d{5}"
                        title="Debe contener exactamente 5 dígitos"
                        maxlength="5"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        required>
                    <div class="invalid-feedback">
                        Por favor ingrese un código postal válido (5 dígitos).
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                        value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}"
                        max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                        required>
                    <div class="invalid-feedback">
                        El cliente debe ser mayor de 18 años.
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad"
                        value="{{ old('edad', $cliente->edad) }}" readonly>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('administrador.clientes.index') }}" class="btn btn-secondary me-2">
                    <i class="bi bi-x-circle me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="bi bi-check-circle me-1"></i> Actualizar Cliente
                </button>
            </div>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Mostrar alertas con animación
    document.addEventListener('DOMContentLoaded', function() {
        const formErrorsAlert = document.getElementById('formErrorsAlert');
        const successAlert = document.getElementById('successAlert');

        if (formErrorsAlert) {
            setTimeout(() => {
                formErrorsAlert.classList.add('show');
            }, 100);
        }

        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('show');

                // Ocultar después de 5 segundos
                setTimeout(() => {
                    successAlert.classList.remove('show');
                }, 5000);
            }, 100);
        }
    });

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
    });

    // Validación del formulario
    const form = document.querySelector('.needs-validation');
    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();

            // Encontrar el primer campo inválido
            const invalidField = form.querySelector(':invalid');
            if (invalidField) {
                invalidField.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                invalidField.classList.add('shake');
                setTimeout(() => invalidField.classList.remove('shake'), 500);
            }
        }
        form.classList.add('was-validated');
    }, false);

    // Validación en tiempo real para email
    function validateEmail(input) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(input.value)) {
            input.setCustomValidity('');
        } else {
            input.setCustomValidity('Por favor ingrese un correo electrónico válido');
        }
    }

    // Capitalizar palabras
    function capitalizeWords(input) {
        input.value = input.value.toLowerCase().replace(/(?:^|\s)\S/g, function(a) {
            return a.toUpperCase();
        });
    }

    // Validar antes de enviar
    document.getElementById('submitBtn').addEventListener('click', function(e) {
        const form = document.querySelector('.needs-validation');
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();

            // Mostrar SweetAlert con errores
            const invalidFields = form.querySelectorAll(':invalid');
            let errorMessages = [];

            invalidFields.forEach(field => {
                errorMessages.push(`• ${field.getAttribute('placeholder') || field.getAttribute('name')}: ${field.validationMessage}`);
            });

            Swal.fire({
                title: 'Error en el formulario',
                html: `Por favor corrija los siguientes campos:<br><br>${errorMessages.join('<br>')}`,
                icon: 'error',
                confirmButtonColor: '#FF7F32'
            });
        }
        form.classList.add('was-validated');
    });
</script>
@endsection