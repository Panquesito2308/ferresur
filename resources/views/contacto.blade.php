@extends('layouts.app-master')

@section('content')

<style>
    /* Estilos generales del contenedor */
    .conten {
        background-color: #f0f1f6;
        padding: 80px 20px;
        text-align: center;
        color: #333;
    }

    /* Título principal */
    .conten h2 {
        font-size: 2.8rem;
        font-weight: 700;
        color: #ff7f00;
        margin-bottom: 20px;
        border-bottom: 4px solid #ff7f00;
        display: inline-block;
        padding-bottom: 10px;
    }

    /* Texto descriptivo */
    .conten p {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin: 10px 0;
    }

    /* Contenedor de contacto */
    .contact-container {
        max-width: 650px;
        margin: 40px auto;
        padding: 40px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Efecto de hover en el contenedor de contacto */
    .contact-container:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
    }

    /* Título del contenedor de contacto */
    .contact-container h2 {
        margin-bottom: 30px;
        font-size: 2.2rem;
        color: #333;
        font-weight: 700;
    }

    /* Párrafos dentro del contenedor de contacto */
    .contact-container p {
        font-size: 1.1rem;
        margin: 8px 0;
        color: #555;
    }

    .contact-container a {
        color: #ff7f00;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .contact-container a:hover {
        color: #e06a1b;
        text-decoration: underline;
    }

    /* Estilo para los iconos de redes sociales */
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 40px;
    }

    .social-icons a {
        font-size: 2.5rem;
        color: #333;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .social-icons a:hover {
        color: #ff7f00;
        transform: scale(1.2);
        /* Efecto de zoom en los iconos */
    }

    .social-icons i {
        transition: transform 0.3s ease;
    }

    /* Fondo del video */
    .hero-section {
        position: relative;
        width: 100%;
        height: 500px;
        overflow: hidden;
    }

    .hero-section video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Título dentro del video */
    .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        z-index: 2;
    }

    .content h1 {
        font-size: 3.5rem;
        font-weight: bold;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
    }

    .content h2 {
        font-size: 2rem;
        font-weight: 600;
        margin-top: 10px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
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
            <h1>CONTACTANOS</h1>
            <h2>CONSTRUYAMOS JUNTOS, SOMOS TU SOCIO COMERCIAL</h2>
        </div>
    </div>

    <div class="conten">
        <!-- Sección de Contacto -->
        <div class="contact-container">
            <h2>Contacto</h2>
            <p><strong>Dirección:</strong> Carr. Perif. Ote. Sur 310, colonia San José de las Flores, 29950 Ocosingo, Chis.</p>
            <p><strong>Teléfono:</strong> <a href="tel:+529191307794">+52 919 130 7794</a></p>
            <p><strong>Correo Electrónico:</strong> <a href="mailto:ferresurmarketing@gmail.com">ferresurmarketing@gmail.com</a></p>
        </div>

        <!-- Redes Sociales -->
        <div class="social-icons">
            <a href="https://www.facebook.com/LaFuerzaParaConstruir/" target="_blank">
                <i class="fab fa-facebook-square"></i>
            </a>
            <a href="https://www.tiktok.com/@ferresurchiapas" target="_blank">
                <i class="fab fa-tiktok"></i>
            </a>
            <a href="https://www.instagram.com/materialesferresur/" target="_blank">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.youtube.com/@FerreteriaFerresurChiapas" target="_blank">
                <i class="fab fa-youtube"></i>
            </a>
        </div>
    </div>

</body>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

@endsection