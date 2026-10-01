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
    <img src="{{ asset('img/banners/CAMPO.png') }}" alt="Inicio" class="banners">

    <section class="content">
        <div class="gallery">
            @foreach (range(1, 8) as $index)
                <div class="image-container">
                    <!-- Título específico para cada imagen -->
                    <div class="image-title">
                        @switch($index)
                            @case(1)
                                Equipos para Cultivo
                                @break
                            @case(2)
                                Tecnología para el Campo
                                @break
                            @case(3)
                                Sistema de Riego
                                @break
                            @case(4)
                                Machete Cacha Negra
                                @break
                            @case(5)
                                Alambre de Alta Resistencia
                                @break
                            @case(6)
                                Cava Agrícola
                                @break
                            @case(7)
                                Despulpadora para Frutas
                                @break
                            @case(8)
                                Fumigador Agrícola
                                @break
                        @endswitch
                    </div>

                    <img src="{{ asset('img/campo/' . ['677db8ff33e2d', '677db9170f294', '677db89602076', '677e8aa7c4b47', 'alambre', 'cava', 'despulpadora', 'fumigador'][$index-1] . '.jpg') }}">

                    <!-- Descripción para cada imagen -->
                    <div class="image-description">
                        @switch($index)
                            @case(1)
                                Equipos para cultivo: herramientas agrícolas de alta eficiencia.
                                @break
                            @case(2)
                                Tecnología avanzada para mejorar la producción agrícola.
                                @break
                            @case(3)
                                Sistema de riego optimizado para cultivos más sostenibles.
                                @break
                            @case(4)
                                La herramienta ideal para trabajos en el campo y el jardín
                                @break
                            @case(5)
                                Alambre de alta resistencia ideal para cercados agrícolas.
                                @break
                            @case(6)
                                Cava agrícola para la protección de cultivos en estaciones cambiantes.
                                @break
                            @case(7)
                                Despulpadora para frutas: extrae jugos de manera eficiente.
                                @break
                            @case(8)
                                Fumigador agrícola para la protección de cultivos.
                                @break
                        @endswitch
                    </div>

                    <!-- Precio y Cantidad -->
                    <div class="image-footer">
                        <div class="price">$ {{ number_format(100 + ($index * 30), 2) }}</div>
                        <div class="quantity">Cantidad disponible: {{ rand(10, 50) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
