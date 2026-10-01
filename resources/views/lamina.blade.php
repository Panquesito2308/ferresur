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

    <img src="{{ asset('img/banners/LAMINAS.png') }}" alt="Inicio" class="banners">

    <section class="content">
        <div class="gallery">
            @foreach (range(1,5) as $index)
                <div class="image-container">
                    <!-- Título específico para cada imagen -->
                    <div class="image-title">
                        @switch($index)
                            @case(1)
                                Lámina Zintro Alum R-72 5.50 ML Cal 26
                                @break
                            @case(2)
                                Placa Antiderrapante Cal 14
                                @break
                            @case(3)
                                Lámina Galvateja Cal 26 4.88 ML
                                @break
                            @case(4)
                                Lámina Zintro Alum 2.42 Cal 32
                                @break
                            @case(5)
                                Lámina Transparente LetsA
                                @break
                        @endswitch
                    </div>

                    <img src="{{ asset('img/lamina/lamina' . $index . '.jpg') }}">

                    <!-- Descripción para cada imagen -->
                    <div class="image-description">
                        @switch($index)
                            @case(1)
                                Lámina Zintro Alum R-72 5.50 ML Cal 26 - Resistente y duradera.
                                @break
                            @case(2)
                                Placa Antiderrapante Cal 14 305 x .91 - Seguridad en cada paso.
                                @break
                            @case(3)
                                Lámina Galvateja Cal 26 4.88 ML Ternium - Protección garantizada.
                                @break
                            @case(4)
                                Lámina Zintro Alum 2.42 Cal 32 - Excelente resistencia contra la corrosión.
                                @break
                            @case(5)
                                Lámina Transparente LetsA - Permite iluminación natural y resistencia.
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
