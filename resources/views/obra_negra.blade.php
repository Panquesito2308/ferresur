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
            top: 0;
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
            bottom: 30px;
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

    <img src="{{ asset('img/banners/NEGRA.png') }}" alt="Inicio" class="banners">

    <section class="content">
        <div class="gallery">
            @foreach (range(1,9) as $index)
                <div class="image-container">
                    <!-- Título -->
                    <div class="image-title">
                        @switch($index)
                            @case(1) Varilla 3/8 de Acero DEA-42 @break
                            @case(2) Anilletas de ¼ @break
                            @case(3) Clavos 2´/1/2 @break
                            @case(4) Cemento Gris Holcim Apasco @break
                            @case(5) Cemento Portland CPC 30R RS BRA 50K @break
                            @case(6) Cemento Blanco Holcim Apasco @break
                            @case(7) Block Hueco 12x20x40 @break
                            @case(8) Aremex 15x20 para Cadena @break
                            @case(9) Alambrón @break
                        @endswitch
                    </div>
                    
                    <img src="{{ asset('img/obranegra/obra' . $index . '.jpg') }}">

                    <!-- Descripción -->
                    <div class="image-description">
                        @switch($index)
                            @case(1)
                                Fortalece tus construcciones con la Varilla 3/8 de Acero DEA-42.
                                @break
                            @case(2)
                                Las Anilletas de ¼ aseguran conexiones con estabilidad y resistencia.
                                @break
                            @case(3)
                                Los Clavos 2´/1/2 ofrecen uniones fuertes y duraderas en carpintería y construcción.
                                @break
                            @case(4)
                                Cemento Gris Holcim Apasco: ideal para albañilería y reparaciones.
                                @break
                            @case(5)
                                Cemento Portland CPC 30R RS BRA 50K: excelente rendimiento y durabilidad.
                                @break
                            @case(6)
                                Cemento Blanco Holcim Apasco para acabados decorativos y estructuras duraderas.
                                @break
                            @case(7)
                                Block Hueco 12x20x40: resistencia y aislamiento térmico/acústico.
                                @break
                            @case(8)
                                Aremex 15x20 para Cadena: resistente y seguro para cercas y estructuras.
                                @break
                            @case(9)
                                Alambrón: flexibilidad y resistencia para construcciones de gran escala.
                                @break
                        @endswitch
                    </div>

                    <!-- Precio y Cantidad -->
                    <div class="image-footer">
                        <div class="price">$ {{ number_format(1 + ($index * 50), 2) }}</div>
                        <div class="quantity">Cantidad disponible: {{ rand(10, 50) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
