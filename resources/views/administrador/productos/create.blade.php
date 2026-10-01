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
            <h1>CREAR PRODUCTO</h1>
        </div>
    </div>
    <section class="conten">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <strong>Error!</strong> Por favor corrige los siguientes errores:
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="card custom-card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('administrador.productos.store') }}" id="productForm">
                                @csrf

                                <!-- Sucursal -->
                                <div class="mb-3">
                                    <label for="id_sucursal" class="form-label">Sucursal</label>
                                    <select name="id_sucursal" id="id_sucursal"
                                        class="form-select @error('id_sucursal') is-invalid @enderror" required>
                                        <option value="" selected disabled>Seleccione una sucursal</option>
                                        @foreach ($sucursales as $sucursal)
                                        <option value="{{ $sucursal->id_sucursal }}" {{ old('id_sucursal') == $sucursal->id_sucursal ? 'selected' : '' }}>
                                            {{ $sucursal->nombre }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_sucursal')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" id="nombre"
                                        class="form-control @error('nombre') is-invalid @enderror"
                                        placeholder="Nombre del producto"
                                        value="{{ old('nombre') }}"
                                        required>
                                    @error('nombre')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea name="descripcion" id="descripcion"
                                        class="form-control @error('descripcion') is-invalid @enderror"
                                        rows="3"
                                        maxlength="30">{{ old('descripcion') }}</textarea>
                                    <small class="text-muted">Máximo 30 caracteres</small>
                                    @error('descripcion')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Precio -->
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="precio" id="precio"
                                            class="form-control @error('precio') is-invalid @enderror"
                                            step="0.01"
                                            min="0"
                                            value="{{ old('precio') }}"
                                            required>
                                        @error('precio')
                                        <div class="invalid-feedback">
                                            <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Stock -->
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" name="stock" id="stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        min="0"
                                        value="{{ old('stock') }}"
                                        required>
                                    @error('stock')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Categoría -->
                                <div class="mb-4">
                                    <label for="categoria" class="form-label">Categoría</label>
                                    <select name="categoria" id="categoria"
                                        class="form-select @error('categoria') is-invalid @enderror" required>
                                        <option value="" disabled selected>Seleccione una categoría</option>
                                        <option value="Obra Negra" {{ old('categoria') == 'Obra Negra' ? 'selected' : '' }}>Obra Negra</option>
                                        <option value="Para El Campo" {{ old('categoria') == 'Para El Campo' ? 'selected' : '' }}>Para El Campo</option>
                                        <option value="Laminas" {{ old('categoria') == 'Laminas' ? 'selected' : '' }}>Laminas</option>
                                        <option value="Balconeria y Herreria" {{ old('categoria') == 'Balconeria y Herreria' ? 'selected' : '' }}>Balconeria y Herreria</option>
                                        <option value="Herramienta" {{ old('categoria') == 'Herramienta' ? 'selected' : '' }}>Herramienta</option>
                                        <option value="Impermeabilizante" {{ old('categoria') == 'Impermeabilizante' ? 'selected' : '' }}>Impermeabilizante</option>
                                        <option value="Plomeria y Fontaneria" {{ old('categoria') == 'Plomeria y Fontaneria' ? 'selected' : '' }}>Plomeria y Fontaneria</option>
                                    </select>
                                    @error('categoria')
                                    <div class="invalid-feedback">
                                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Botones -->
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <a href="{{ route('administrador.productos.index') }}" class="btn btn-secondary me-md-2">
                                        <i class="bi bi-x-circle me-1"></i> Cancelar
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Crear Producto
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
        .custom-card .form-select,
        .custom-card .input-group-text {
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

        /* Input group para precio */
        .input-group-text {
            background-color: #f8f9fa;
            color: #495057;
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