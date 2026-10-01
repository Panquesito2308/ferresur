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

        .price {
            font-weight: bold;
            font-size: 16px;
        }

        .quantity {
            font-size: 14px;
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

        .description {
            display: none;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 10px;
            border-radius: 5px;
            width: 90%;
            text-align: center;
        }

        .image-container:hover .description {
            display: block;
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

    </style>

    <img src="{{ asset('img/banners/HERRERIA.png') }}" alt="Inicio" class="banners">

    <section class="content">
        <div class="gallery">
            @foreach (range(1,6) as $index)
                <div class="image-container">
                    <!-- Título específico para cada imagen -->
                    <div class="image-title">
                        @switch($index)
                            @case(1)
                                Redondo Estructural
                                @break
                            @case(2)
                                Tubo Negro Cédula 30
                                @break
                            @case(3)
                                Polín Montel 10x10
                                @break
                            @case(4)
                                PTR Cal 14, 2x2
                                @break
                            @case(5)
                                Duela Ara Circular Combinado 1.83
                                @break
                            @case(6)
                                Ángulo Estructural 1/4"
                                @break
                        @endswitch
                    </div>
                    
                    <img src="{{ asset('img/balconeriaherreria/perfi' . $index . '.jpg') }}">

                    <!-- Descripción para cada imagen -->
                    <div class="description">
                        @switch($index)
                            @case(1)
                                <p>El Redondo Estructural es ideal para estructuras metálicas resistentes.</p>
                                @break
                            @case(2)
                                <p>El Tubo Negro Cédula 30 es perfecto para conducción de fluidos.</p>
                                @break
                            @case(3)
                                <p>El Polín Montel 10x10 brinda estabilidad en techos y estructuras.</p>
                                @break
                            @case(4)
                                <p>El PTR Cal 14, 2x2 es ideal para estructuras metálicas resistentes.</p>
                                @break
                            @case(5)
                                <p>La Duela Ara Circular Combinado 1.83 es perfecta para acabados elegantes.</p>
                                @break
                            @case(6)
                                <p>El Ángulo Estructural de 1/4" proporciona soporte en construcciones.</p>
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
