@extends('layouts.app-master')

@section('content')

<style>
    /* Contenedor principal */
    .conten {
        background-color: #f8f9fa;
        padding: 60px 20px;
    }

    /* Sección de contenido */
    .content-section {
        position: relative;
        z-index: 1;
        padding: 40px 20px;
    }

    /* Título de la sección */
    .section-title {
        text-align: center;
        font-size: 2.5rem;
        color: #333;
        margin-bottom: 40px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Contenedor de tarjetas */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        margin: 40px 0;
    }

    /* Estilo de las tarjetas */
    .custom-card {
        width: 100%;
        max-width: 380px;
        /* Ancho ajustado */
        height: 480px;
        /* Altura ajustada */
        border-radius: 12px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Efecto hover en las tarjetas */
    .custom-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }

    /* Estilo de las imágenes dentro de las tarjetas */
    .custom-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
    }

    .custom-card:hover img {
        transform: scale(1.1);
        /* Zoom en la imagen */
    }

    /* Cuerpo de la tarjeta */
    .card-body {
        padding: 30px 20px;
        text-align: center;
        background-color: #fff;
    }

    /* Título dentro de la tarjeta */
    .card-title {
        font-size: 1.8rem;
        color: #333;
        margin-bottom: 15px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    /* Texto dentro de la tarjeta */
    .card-text {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 20px;
        line-height: 1.6;
        font-weight: 400;
    }

    /* Estilo del botón */
    .btn-primary {
        background-color: #ff7f32;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
        color: white;
        letter-spacing: 0.5px;
    }

    .btn-primary:hover {
        background-color: #e06a1b;
    }

    .btn-primary:focus {
        outline: none;
    }
</style>

<head>
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">
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
            <h1>FERRESUR EN ACCIÓN</h1>
        </div>
    </div>

    <div class="conten">
        <h2 class="section-title">Nuestros programas sociales</h2>
        <div class="card-container">
            <!-- Tarjeta 1 -->
            <div class="custom-card">
                <img src="{{ asset('img/deporte4.jpg') }}" alt="Deporte">
                <div class="card-body">
                    <h5 class="card-title">Apoyo al deporte</h5>
                    <p class="card-text">
                        Apoyamos a equipos y eventos locales, impulsando el espíritu de superación y desarrollo
                        personal a través del deporte, fomentando la unión y el bienestar en nuestra comunidad.
                        no XDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD
                    </p>
                </div>
            </div>

            <!-- Tarjeta 2 -->
            <div class="custom-card">
                <img src="{{ asset('img/capacitacion3.jpg') }}" alt="Capacitación">
                <div class="card-body">
                    <h5 class="card-title">Capacitación Profesional</h5>
                    <p class="card-text">
                        Ofrecemos capacitaciones para fortalecer las habilidades de los constructores locales,
                        mejorando la calidad de los proyectos en la región y aportando valor a la industria.
                    </p>
                </div>
            </div>

            <!-- Tarjeta 3 -->
            <div class="custom-card">
                <img src="{{ asset('img/donacion4.jpg') }}" alt="Responsabilidad Social">
                <div class="card-body">
                    <h5 class="card-title">Responsabilidad social</h5>
                    <p class="card-text">
                        Participamos activamente en proyectos de impacto social y ambiental, colaborando con
                        iniciativas locales que promueven el bienestar de la comunidad.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>


@endsection