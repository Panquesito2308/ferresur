@extends('layouts.app-master')

@section('content')
    <style>
        .banners {
            display: block;
            width: 100%;
            height: auto;
            max-height: 100vh;
            object-fit: cover;
            margin: 0;
            padding: 0;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            padding: 20px;
        }

        .image-container {
            position: relative;
            display: inline-block;
            width: 300px;
        }

        .image-container img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .image-container:hover img {
            transform: scale(1.05);
        }

        .image-title {
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            font-size: 16px;
            text-align: center;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }

        .image-description {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px;
            font-size: 14px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .image-container:hover .image-description {
            opacity: 1;
        }

        .image-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            font-size: 14px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }

        .image-container:hover .image-footer {
            opacity: 0;
        }

        .price {
            font-weight: bold;
            font-size: 16px;
        }

        .quantity {
            font-size: 14px;
        }

    </style>

    <img src="{{ asset('img/banners/IMPERMEABILIZANTE.png') }}" alt="Inicio" class="banners">

    <section class="content">
        <div class="gallery">
            @foreach (range(1,9) as $index)
                <div class="image-container">
                    <!-- Título específico para cada imagen -->
                    <div class="image-title">
                        @switch($index)
                            @case(1)
                                Impac Sello Galón o Cubeta
                                @break
                            @case(2)
                                Impac Cemento Plástico 1kg
                                @break
                            @case(3)
                                Impac Malla de Refuerzo
                                @break
                            @case(4)
                                Carpeta Asfáltica 3.50 ml
                                @break
                            @case(5)
                                Impermeabilizante 5000 Blanco
                                @break
                            @case(6)
                                Impermeabilizante 3000 Blanco
                                @break
                            @case(7)
                                Banda Tapa Gotera Impac
                                @break
                            @case(8)
                                Impermeabilizante Blanco IMPAC 19L
                                @break
                            @case(9)
                                Impermeabilizante Blanco IMPAC
                                @break
                        @endswitch
                    </div>

                    <img src="{{ asset('img/impermeabilizante/1' . $index . '.jpg') }}">

                    <!-- Descripción para cada imagen -->
                    <div class="image-description">
                        @switch($index)
                            @case(1)
                                El Impac Sello Galón o Cubeta es la solución perfecta para garantizar un sellado eficaz en tus productos.
                                @break
                            @case(2)
                                El Impac Cemento Plástico de 1kg es el aliado perfecto para tus proyectos de reparación y construcción.
                                @break
                            @case(3)
                                La Impac Malla de Refuerzo es ideal para proporcionar mayor estabilidad y durabilidad en tus proyectos de construcción.
                                @break
                            @case(4)
                                La Carpeta Asfáltica de 3.50 ml es la solución perfecta para proteger superficies expuestas a condiciones climáticas extremas.
                                @break
                            @case(5)
                                Protege y prolonga la vida útil de tus superficies con el Impermeabilizante 5000 Blanco 5 Años.
                                @break
                            @case(6)
                                Mantén tus superficies protegidas con el Impermeabilizante 3000 Blanco 3 Años.
                                @break
                            @case(7)
                                Evita filtraciones y protege tu hogar con la Banda Tapa Gotera Impac.
                                @break
                            @case(8)
                                El impermeabilizante blanco IMPAC de 19 litros ofrece una cobertura duradera de hasta 3 años.
                                @break
                            @case(9)
                                Asegura la protección duradera de tus superficies con el impermeabilizante blanco IMPAC.
                                @break
                        @endswitch
                    </div>

                    <!-- Precio y Cantidad -->
                    <div class="image-footer">
                        <div class="price">$ {{ number_format(100 + ($index * 50), 2) }}</div>
                        <div class="quantity">Cantidad disponible: {{ rand(10, 50) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
