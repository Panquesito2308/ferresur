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
            <h1>VENTAS AL MAYOREO</h1>
        </div>
    </div>

    <div class="conten">
        <div class="cta-content">
            <h1 class="cta-title">
                Cotiza Ahora
            </h1>
            <h3 class="cta-subtitle">
                <strong>¡¿Deseas algún producto?, Cotizalo en nuestro chat!</strong>
            </h3>
            <a class="cta-button"
                href="https://wa.me/+529191307794"
                target="_blank"
                rel="noopener">
                <i class="fab fa-whatsapp"></i>
                HAZ CLIC PARA COTIZAR AHORA
            </a>
        </div>
        <div class="info-section">
            <!-- Columna izquierda -->
            <div class="info-left">
                <h2>Nuestro chat <br> está listo para ayudarte<br><br>
                    <p><em>Importante: Atendemos únicamente en nuestro horario laboral</em></p>
            </div>

            <!-- Columna derecha -->
            <div class="info-right">
                <div class="info-item">
                    <i class="fas fa-comments"></i>
                    <div>
                        <h3>Chat especialmente para ti</h3>
                        <p>Estamos ansiosos por atenderte, da clic en el botón de Cotiza Ahora y recibe <strong>atención personalizada.</strong></p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fab fa-whatsapp"></i>
                    <div>
                        <h3>WhatsApp</h3>
                        <p>Cotiza de inmediato en nuestro WhatsApp. Solo da clic en el botón de WhatsApp abajo a la derecha, RECUERDA: SOLO ATENDEREMOS EN HORARIO LABORAL</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<style>
    .conten {
        background-color: #f8f9fa;
        padding: 60px 20px;
    }

    /* Contenido */
    .cta-content {
        font-family: 'Montserrat', sans-serif;
        text-align: center;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.14);
        /* Fondo semitransparente */
        border-radius: 12px;
    }

    /* Título */
    .cta-title {
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    /* Subtítulo */
    .cta-subtitle {
        font-size: 20px;
        font-weight: 400;
        margin-bottom: 20px;
    }

    /* Botón */
    .cta-button {
        display: inline-flex;
        align-items: center;
        background-color: #ff6514;
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        padding: 14px 28px;
        border-radius: 30px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        transition: background-color 0.3s ease;
    }

    .cta-button i {
        margin-right: 10px;
        font-size: 20px;
    }

    .cta-button:hover {
        background-color: #cc0510;
    }

    /* Para hacerlo responsive */
    @media (max-width: 768px) {
        .cta-title {
            font-size: 32px;
        }

        .cta-subtitle {
            font-size: 16px;
        }

        .cta-button {
            font-size: 14px;
            padding: 12px 24px;
        }
    }


    /*cards */
    .info-section {
        display: flex;
        color: #fff;
        padding: 40px;
        border-radius: 12px;
        overflow: hidden;
    }

    /* Columna izquierda */
    .info-left {
        background-color: #ff6514;
        padding: 40px;
        flex: 1;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .info-left h2 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .info-left p {
        font-size: 16px;
        font-style: italic;
        color: #f5f5f5;
    }

    /* Columna derecha */
    .info-right {
        background-color: #424343;
        padding: 40px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .info-item {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .info-item i {
        font-size: 32px;
        color: #ff6514;
    }

    .info-item h3 {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .info-item p {
        font-size: 16px;
        color: #ccc;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .info-section {
            flex-direction: column;
            padding: 20px;
        }

        .info-left,
        .info-right {
            padding: 20px;
        }

        .info-left h2 {
            font-size: 24px;
        }

        .info-item i {
            font-size: 24px;
        }
    }
</style>

<!-- FontAwesome para el icono de WhatsApp -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection