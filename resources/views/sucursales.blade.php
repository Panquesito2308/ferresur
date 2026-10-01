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
            <h1>Nuestras Sucursales</h1>
        </div>
    </div>

    <div class="conten">
        <div class="text-center mb-5">
            <h2 class="title-gradient">Sobre Nosotros</h2>
            <p class="description">
                Grupo Ferresur es el líder en el sector ferretero en Chiapas, con más de 30 años de experiencia y un sólido equipo
                que nos posiciona como el socio estratégico ideal para proyectos de gran alcance. Con una red de más de 10 sucursales,
                ofrecemos una experiencia de compra excepcional, respaldada por productos de alta calidad y un servicio al cliente impecable.
            </p>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <h3 class="subtitle-gradient">Nuestras Sucursales</h3>
                <p class="text">
                    Descubre nuestras sucursales estratégicamente ubicadas en todo Chiapas, donde te ofrecemos un servicio personalizado,
                    productos de calidad y asesoría especializada. En cada una de ellas, encontrarás un equipo comprometido a brindarte
                    soluciones para todos tus proyectos de construcción.
                </p>
                <div class="form-group">
                    <label for="mode">Selecciona tu modo de viaje:</label>
                    <select id="mode" class="form-select">
                        <option value="driving">Conduciendo</option>
                        <option value="walking">Caminando</option>
                        <option value="bicycling">Bicicleta</option>
                    </select>
                </div>

                <div class="button-container">
                    <button class="municipio-btn" data-place="Teopisca">Teopisca</button>
                    <button class="municipio-btn" data-place="Oxchuc">Oxchuc</button>
                    <button class="municipio-btn" data-place="Ocosingo">Ocosingo</button>
                    <button class="municipio-btn" data-place="Yajalón">Yajalón</button>
                    <button class="municipio-btn" data-place="Chilón">Chilón</button>
                </div>
            </div>

            <div class="col-lg-6">
                <iframe id="map" class="map" allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <script>
        let mapIframe = document.getElementById("map");
        let modeSelect = document.getElementById("mode");

        const sucursales = {
            "Teopisca": "Ferresur Teopisca, Chiapas, México",
            "Oxchuc": "Ferresur Oxchuc, Chiapas, México",
            "Ocosingo": "Ferresur Ocosingo, Chiapas, México",
            "Yajalón": "Ferresur Yajalón, Chiapas, México",
            "Chilón": "Ferresur Chilón, Chiapas, México",
            "Sucursal Matriz": "Ferresur Sucursal Matriz, Chiapas, México"
        };

        function updateMap(place) {
            const query = encodeURIComponent(sucursales[place]);
            const mapUrl = `https://www.google.com/maps/embed/v1/place?key=AIzaSyCbKSWv3YL0deIj6i6F_d1q_tQrMQGzw8Y&q=${query}`;
            mapIframe.src = mapUrl;
        }

        document.querySelectorAll(".municipio-btn").forEach(button => {
            button.addEventListener("click", function() {
                const place = this.getAttribute("data-place");
                updateMap(place);
            });
        });

        modeSelect.addEventListener("change", () => updateMap("Ocosingo"));
        updateMap("Ocosingo");
    </script>
    <style>
        /* Contenedor principal */
        .conten {
            padding: 40px 20px;
            background-color: #fff;
        }

        /* Títulos con gradiente */
        .title-gradient,
        .subtitle-gradient {
            background: linear-gradient(to right, #ff6514, #cc6600);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .subtitle-gradient {
            font-size: 1.5rem;
        }

        /* Descripción */
        .description,
        .text {
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        /* Select y etiquetas */
        .form-group label {
            font-weight: 600;
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-select:focus {
            border-color: #ff6514;
            outline: none;
        }

        /* Botones de municipios */
        .button-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .municipio-btn {
            background: linear-gradient(to right, #ff7f33, #cc5500);
            /* Colores más suaves */
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.4s ease-in-out, transform 0.2s ease-in-out;
        }

        .municipio-btn:hover {
            background: linear-gradient(to right, #cc5500, #ff7f33);
            /* Cambio suave de color */
            transform: translateY(-1px);
        }


        /* Mapa */
        .map {
            width: 100%;
            height: 400px;
            border: 0;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
    @endsection