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

    <img src="{{ asset('img/banners/HERRAMIENTAS.png') }}" alt="Inicio" class="banners">

    <section class="content">
        <div class="gallery">
            @foreach (range(1,9) as $index)
                <div class="image-container">
                    <!-- Título específico para cada imagen -->
                    <div class="image-title">
                        @switch($index)
                            @case(1)
                                Vibratorio CIPSA 6.5 HP
                                @break
                            @case(2)
                                Rotomartillo Makita
                                @break
                            @case(3)
                                Planta para Soldar Arctron 130 Infra
                                @break
                            @case(4)
                                Hidrolavadora Makita
                                @break
                            @case(5)
                                Esmeriladora Makita 115 mm 540W
                                @break
                            @case(6)
                                Sierra Circular Makita 185mm
                                @break
                            @case(7)
                                Compresor 3HP Lubricado
                                @break
                            @case(8)
                                Revolvedora Motor 9HP CIPSA
                                @break
                            @case(9)
                                Carretilla Naranja Neumático 4 Capas
                                @break
                        @endswitch
                    </div>

                    <img src="{{ asset('img/herramienta/herra' . $index . '.jpg') }}">

                    <!-- Descripción para cada imagen -->
                    <div class="image-description">
                        @switch($index)
                            @case(1)
                                Potencia y eficiencia para tus proyectos de construcción con el Vibratorio CIPSA de 6.5 HP.
                                @break
                            @case(2)
                                ¡Potencia y precisión en tus manos! El Rotomartillo Makita es la herramienta perfecta para perforar y demoler.
                                @break
                            @case(3)
                                ¡Lleva tus proyectos de soldadura al siguiente nivel con la Planta para Soldar Arctron 130 Infra!
                                @break
                            @case(4)
                                ¡Obtén resultados profesionales de limpieza con la Hidrolavadora Makita!
                                @break
                            @case(5)
                                ¡La Esmeriladora Makita 115 mm 540W es la herramienta perfecta para tus trabajos de corte y pulido!
                                @break
                            @case(6)
                                ¡Lleva tus proyectos de corte al siguiente nivel con la Sierra Circular Makita 185mm!
                                @break
                            @case(7)
                                ¡Potencia y rendimiento a tu alcance con el Compresor 3HP Lubricado - Modelo COMP/25 LT!
                                @break
                            @case(8)
                                La Revolvedora con Motor 9HP MP Ultra 10 CIPSA es la herramienta perfecta para agilizar tus trabajos de construcción.
                                @break
                            @case(9)
                                La Carretilla Naranja Neumático 4 Capas CAT/45ND Truper es tu aliada perfecta para trabajos de carga y transporte.
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
