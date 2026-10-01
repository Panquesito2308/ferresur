@extends('layouts.app-master')

@section('content')

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
            <h1>¿Quiénes Somos?</h1>
        </div>
    </div>

    <!-- Quiénes Somos -->
    <section class="conten">
        <p>
            Somos una empresa totalmente responsable, que busca otorgar la mejor atención al cliente
            y brindarle un mejor servicio.
        </p>
    </section>

    <!-- Misión y Visión -->
    <div class="conten">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-5 col-sm-12">
                <div class="single-foot-widget">
                    <h2>Misión</h2>
                    <p>
                        Satisfacer las necesidades de nuestros clientes trabajando en la mejora continua,
                        brindando la mejor solución en materiales de construcción, herrería y ferretería.
                        Generando valor para nuestros clientes, colaboradores, proveedores y accionistas.
                    </p>
                </div>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-12">
                <div class="single-foot-widget">
                    <h2>Visión</h2>
                    <p>
                        En el 2030, seguir siendo el mejor y más confiable proveedor en el mercado de
                        materiales para la construcción, herrería y ferretería. Acercándonos cada vez
                        más a nuestros clientes con 3 nuevos puntos de venta, a través de soluciones
                        innovadoras y sostenibles.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Valores -->
    <section class="values-section">
        <h2>Valores</h2>
        <ul class="values-list">
            <li>
                <i class="fas fa-shield-alt"></i>
                <div>
                    <strong>Garantía</strong>
                    <p>Dar garantía y seguridad a nuestros clientes, colaboradores y accionistas.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-balance-scale"></i>
                <div>
                    <strong>Congruencia</strong>
                    <p>Ser honestos, leales y cumplir con los procesos y políticas de la empresa.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-users"></i>
                <div>
                    <strong>Trabajo en equipo</strong>
                    <p>Juntos somos la fuerza para lograr buenos resultados.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-lightbulb"></i>
                <div>
                    <strong>Innovación</strong>
                    <p>Buscar nuevas estrategias para llegar a nuestros clientes.</p>
                </div>
            </li>
            <li>
                <i class="fas fa-leaf"></i>
                <div>
                    <strong>Sostenibilidad</strong>
                    <p>Contribuir positivamente a la naturaleza y la sociedad.</p>
                </div>
            </li>
        </ul>
    </section>
</body>
<style>
    /* Sección Quiénes Somos */
    .conten {
        background-color: #f8f9fa;
        padding: 60px 20px;
        text-align: center;
    }

    .conten h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 20px;
        border-bottom: 3px solid #ff7f00;
        /* Línea naranja */
        display: inline-block;
        padding-bottom: 5px;
    }

    .conten p {
        font-size: 30px;
        line-height: 1.6;
        color: #555;
    }

    /* Misión y Visión */
    .single-foot-widget {
        background-color: #ffffff;
        padding: 30px;
        border: 1px solid #dee2e6;
        border-left: 5px solidrgb(114, 63, 15);
        /* Línea naranja en el borde izquierdo */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .single-foot-widget h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #343a40;
        margin-bottom: 15px;
        border-bottom: 3px solid #ff7f00;
        /* Línea naranja */
        display: inline-block;
        padding-bottom: 5px;
    }

    .single-foot-widget p {
        font-size: 1rem;
        color: #555;
        line-height: 1.6;
    }

    .single-foot-widget:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    /* Valores */
    .values-section {
        background-color: #f8f9fa;
        padding: 60px 20px;
        text-align: center;
    }

    .values-section h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 30px;
        border-bottom: 3px solid #ff7f00;
        /* Línea naranja */
        display: inline-block;
        padding-bottom: 5px;
    }

    .values-list {
        list-style: none;
        padding: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .values-list li {
        display: flex;
        align-items: flex-start;
        background-color: #ffffff;
        padding: 20px;
        border: 1px solid #dee2e6;
        border-left: 5px solid #ff7f00;
        /* Línea naranja en el borde izquierdo */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .values-list li i {
        font-size: 2rem;
        color: #ff7f00;
        /* Iconos en naranja */
        margin-right: 15px;
    }

    .values-list li div strong {
        font-size: 1.2rem;
        font-weight: 700;
        color: #343a40;
    }

    .values-list li div p {
        font-size: 1rem;
        color: #555;
        margin-top: 5px;
        line-height: 1.5;
    }

    .values-list li:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
</style>
@endsection