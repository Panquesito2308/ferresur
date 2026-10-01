<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ferresur</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .footer-area {
            background-color: rgb(41, 40, 40);
            /* Fondo gris oscuro */
            color: #ffffff;
            /* Texto blanco */
            padding: 20px 0;
            /* Reducido de 40px a 20px */
            text-align: justify;
        }

        .footer-social a {
            margin: 0 10px;
            color: #ffffff;
            font-size: 18px;
            transition: color 0.3s;
        }

        .footer-social a:hover {
            color: #f0ad4e;
            /* Color al pasar el cursor */
        }

        .single-footer-widget h6 {
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .single-footer-widget p {
            font-size: 14px;
            line-height: 1.5;
        }
    </style>
</head>

<body>

    <footer class="footer-area section_gap">
        <div class="container text-center">
            <p>
                © {{ date('Y') }} Ferresur. Todos los derechos reservados.
            </p>
            <div class="">
                <div class="single-footer-widget text-center">
                    <h6 style="font-size: 22px; font-weight: bold; color: #f8f9fa; margin-bottom: 15px;">
                        Síguenos
                    </h6>
                    <p style="font-size: 16px; color: #d1d1d1; line-height: 1.6; margin-bottom: 20px;">
                        Conéctate con nosotros en nuestras redes sociales y no te pierdas nuestras últimas novedades, promociones y eventos especiales.
                    </p>
                    <div class="footer-social d-flex justify-content-center align-items-center" style="gap: 25px;">
                        <a href="https://www.facebook.com/LaFuerzaParaConstruir/" target="_blank" aria-label="Facebook">
                            <i class="fab fa-facebook-f" style="font-size: 40px; color:white; transition: transform 0.3s;"></i>
                        </a>
                        <a href="https://www.instagram.com/materialesferresur/" target="_blank" aria-label="Instagram">
                            <i class="fab fa-instagram" style="font-size: 40px; color:white; transition: transform 0.3s;"></i>
                        </a>
                        <a href="https://www.tiktok.com/@ferresurchiapas" target="_blank" aria-label="TikTok">
                            <i class="fab fa-tiktok" style="font-size: 40px; color:white; transition: transform 0.3s;"></i>
                        </a>
                        <a href="https://www.youtube.com/@FerreteriaFerresurChiapas" target="_blank" aria-label="YouTube">
                            <i class="fab fa-youtube" style="font-size: 40px; color:white; transition: transform 0.3s;"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </footer>