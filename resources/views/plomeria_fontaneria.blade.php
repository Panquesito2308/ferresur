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

        .gallery img {
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

        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
    </style>

    <!-- Imagen de fondo -->
    <img src="{{ asset('img/banners/PLOMERIA.png') }}" alt="Inicio" class="banners">

    <section class="content">
        <div class="gallery">
            @foreach (range(1, 9) as $index)
                <div class="image-container">
                    <!-- Título específico para cada imagen -->
                    <div class="image-title">
                        @switch($index)
                            @case(1)
                                Fittings de PVC
                                @break
                            @case(2)
                                Tubo Cobre Tipo M
                                @break
                            @case(3)
                                Tubos de PVC de Alta Resistencia
                                @break
                            @case(4)
                                Codos de 90°
                                @break
                            @case(5)
                                Válvulas de Cierre
                                @break
                            @case(6)
                                Sellos y Empaques de Goma
                                @break
                            @case(7)
                                Cinta Teflón
                                @break
                            @case(8)
                                Pipas de PVC
                                @break
                            @case(9)
                                Reparación de Fugas
                                @break
                        @endswitch
                    </div>

                    <img src="{{ asset('img/plomeria/' . $index . '.jpg') }}">

                    <!-- Descripción para cada imagen -->
                    <div class="image-description">
                        @switch($index)
                            @case(1)
                                Fittings de PVC para plomería: soluciones de calidad para conexiones duraderas.
                                @break
                            @case(2)
                                Herramientas para plomería: Tubo Cobre Tipo M esenciales para una instalación profesional.
                                @break
                            @case(3)
                                Tubos de PVC de alta resistencia, ideales para sistemas de fontanería duraderos.
                                @break
                            @case(4)
                                Codos de 90°: perfectos para cambiar la dirección de los conductos de agua.
                                @break
                            @case(5)
                                Válvulas de cierre: esenciales para controlar el flujo de agua en el sistema.
                                @break
                            @case(6)
                                Sellos y empaques de goma para una instalación hermética y sin filtraciones.
                                @break
                            @case(7)
                                Cinta teflón para conexiones a prueba de fugas.
                                @break
                            @case(8)
                                Pipas de PVC para el manejo de agua potable y residuales.
                                @break
                            @case(9)
                                Reparación de fugas: solución eficaz con materiales de calidad.
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
