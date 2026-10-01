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
            <h1>INICIO DE SESIÓN</h1>
        </div>
    </div>

    <div class="conten">
        <div class="container d-flex align-items-center justify-content-center py-5">
            <div class="card custom-card">

                @if(session('login_attempts'))
                <div class="alert alert-warning">
                    ⚠️ Intentos fallidos: {{ session('login_attempts') }}/3
                </div>
                @endif

                @if(session('account_locked'))
                <div class="alert alert-danger">
                    ⛔ Cuenta bloqueada temporalmente. Intente nuevamente en 1 minuto.
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required autofocus autocomplete="username" maxlength="20" @if(session('account_locked')) disabled @endif>
                        @error('username')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password" minlength="8" maxlength="10" pattern=".{8,10}" title="La contraseña debe tener entre 8 y 10 caracteres" @if(session('account_locked')) disabled @endif>
                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                <i class="bi bi-eye-slash"></i>
                            </button>
                        </div>
                        <small class="text-muted">🔑 La contraseña debe tener entre 8 y 10 caracteres</small>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" @if(session('account_locked')) disabled @endif>
                            Iniciar Sesión
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');
                input.type = input.type === 'password' ? 'text' : 'password';
                icon.classList.toggle('bi-eye');
                icon.classList.toggle('bi-eye-slash');
            });
        });

        document.getElementById('password').addEventListener('input', function() {
            if (this.value.length > 10) {
                this.value = this.value.slice(0, 10);
            }
        });
    </script>
    <style>
        /* Estilo para la sección de contenido */
        .conten {
            background-color: #f8f9fa;
            min-height: calc(100vh - 200px);
        }

        /* Estilos de la tarjeta de login */
        .custom-card {
            max-width: 450px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 2.5rem;
            text-align: center;
            border: none;
        }

        /* Alertas */
        .alert {
            border-radius: 8px;
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        /* Texto de ayuda */
        .text-muted {
            font-size: 0.8rem;
            color: #6c757d;
            display: block;
            text-align: left;
            margin-top: 0.25rem;
        }

        /* Campos de texto */
        .custom-card .form-label {
            color: #333;
            font-weight: 500;
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
        }

        .custom-card .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s;
            height: 45px;
        }

        .custom-card .form-control:disabled {
            background-color: #e9ecef;
        }

        .custom-card .form-control:focus {
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

        /* Botón de iniciar sesión */
        .custom-card .btn-primary {
            background-color: #ff7f32;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s;
            height: 45px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .custom-card .btn-primary:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }

        .custom-card .btn-primary:hover:not(:disabled) {
            background-color: #e06a1b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(224, 106, 27, 0.3);
        }

        /* Estilos de los mensajes de error */
        .text-danger {
            font-size: 0.85rem;
            color: #dc3545;
            display: block;
            text-align: left;
            margin-top: 0.25rem;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .custom-card {
                padding: 1.5rem;
                margin: 0 15px;
            }
        }
    </style>
</body>
@endsection