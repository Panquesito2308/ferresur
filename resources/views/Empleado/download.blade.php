@extends('layouts.app-master')

@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/banner-others.css') }}">

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --admin-color: #8e44ad;
            --employee-color: #3498db;
            --accent-color: #f39c12;
            --light-color: #ecf0f1;
            --success-color: #27ae60;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }

        .hero-section {
            position: relative;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            overflow: hidden;
        }

        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .hero-content {
            max-width: 800px;
            padding: 0 20px;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease 0.2s forwards;
            opacity: 0;
        }

        .cta-button {
            display: inline-block;
            background-color: var(--accent-color);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
            animation: fadeInUp 1s ease 0.4s forwards;
            opacity: 0;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
            background-color: #e67e22;
        }

        .features-section {
            padding: 80px 20px;
            background-color: #f8f9fa;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-title h2:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title p {
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
            font-size: 1.1rem;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .role-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            margin-bottom: 80px;
        }

        .role-card {
            flex: 1;
            min-width: 300px;
            max-width: 450px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .role-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .role-header {
            padding: 25px;
            color: white;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .role-header h3 {
            font-size: 1.5rem;
            margin: 0;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .role-header:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0) 100%);
        }

        .admin-header {
            background: linear-gradient(135deg, var(--admin-color) 0%, #6c3483 100%);
        }

        .employee-header {
            background: linear-gradient(135deg, var(--employee-color) 0%, #2874a6 100%);
        }

        .feature-list {
            padding: 25px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease;
        }

        .feature-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-icon {
            flex-shrink: 0;
            width: 40px;
            height: 40px;
            background-color: rgba(243, 156, 18, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--accent-color);
            font-size: 1.1rem;
        }

        .feature-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--primary-color);
        }

        .feature-content p {
            color: var(--text-light);
            font-size: 0.95rem;
            margin: 0;
        }

        .download-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 80px 20px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .download-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="50" height="50" x="0" y="0" fill="white" opacity="0.05"/><rect width="50" height="50" x="50" y="50" fill="white" opacity="0.05"/></svg>');
            background-size: 30px 30px;
        }

        .download-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .download-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: var(--shadow);
            max-width: 800px;
            margin: 0 auto;
            color: var(--text-color);
        }

        .download-card h2 {
            color: var(--primary-color);
            margin-bottom: 15px;
            font-size: 2rem;
        }

        .download-card p {
            color: var(--text-light);
            margin-bottom: 30px;
        }

        .qr-container {
            margin: 25px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .qr-code {
            width: 180px;
            height: 180px;
            border: 1px solid #eee;
        }

        .download-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .download-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--accent-color);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
        }

        .download-btn:hover {
            background: #e67e22;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(243, 156, 18, 0.4);
        }

        .steps-container {
            margin-top: 40px;
        }

        .steps-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        .steps {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .step {
            flex: 1;
            min-width: 200px;
            max-width: 250px;
            background: var(--light-color);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: var(--transition);
        }

        .step:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .step-content {
            font-size: 0.95rem;
            color: var(--text-light);
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-content p {
                font-size: 1.1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .role-card {
                min-width: 100%;
            }

            .download-buttons {
                flex-direction: column;
                align-items: center;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <video class="background-video" autoplay loop muted playsinline>
            <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
            Tu navegador no soporta el formato de video.
        </video>
        <div class="hero-content">
            <h1>App de Gestión Ferretera</h1>
            <p>La solución integral para administrar pedidos, inventario y equipos con máxima eficiencia</p>
            <a href="#download" class="cta-button">Descargar Ahora</a>
        </div>
    </div>

    <!-- Features Section -->
    <section class="features-section">
        <div class="features-container">
            <div class="section-title">
                <h2>Funcionalidades Clave</h2>
                <p>Diseñada para simplificar y optimizar la gestión diaria de tu ferretería o negocio de materiales</p>
            </div>

            <div class="role-cards">
                <!-- Admin Card -->
                <div class="role-card">
                    <div class="role-header admin-header">
                        <h3><i class="fas fa-user-shield"></i> Panel Administrativo</h3>
                    </div>
                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-tasks"></i></div>
                            <div class="feature-content">
                                <h4>Gestión de Pedidos</h4>
                                <p>Asigna y redistribuye pedidos en tiempo real según disponibilidad del equipo.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-chart-pie"></i></div>
                            <div class="feature-content">
                                <h4>Dashboard Analítico</h4>
                                <p>Métricas de desempeño, ventas y productividad en tiempo real.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-file-invoice"></i></div>
                            <div class="feature-content">
                                <h4>Reportes Automatizados</h4>
                                <p>Genera reportes diarios, semanales y mensuales en PDF o Excel.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-users-cog"></i></div>
                            <div class="feature-content">
                                <h4>Gestión de Equipos</h4>
                                <p>Administra permisos, horarios y asignaciones de todo tu personal.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Employee Card -->
                <div class="role-card">
                    <div class="role-header employee-header">
                        <h3><i class="fas fa-user-hard-hat"></i> Panel de Empleados</h3>
                    </div>
                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div class="feature-content">
                                <h4>Tareas Asignadas</h4>
                                <p>Visualiza tus pedidos pendientes con prioridades claras y plazos.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-check-circle"></i></div>
                            <div class="feature-content">
                                <h4>Actualización de Estados</h4>
                                <p>Marca pedidos como completados o reporta problemas con fotos.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-exchange-alt"></i></div>
                            <div class="feature-content">
                                <h4>Sincronización Offline</h4>
                                <p>Trabaja sin conexión y los datos se sincronizan automáticamente.</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-comment-dots"></i></div>
                            <div class="feature-content">
                                <h4>Chat Integrado</h4>
                                <p>Comunicación directa con administradores y otros empleados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section class="download-section" id="download">
        <div class="download-container">
            <div class="download-card">
                <h2>Descarga la Aplicación</h2>
                <p>Disponible exclusivamente para dispositivos Android. Instala la app y lleva tu gestión al siguiente nivel.</p>

                <div class="qr-container">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=https://drive.google.com/file/d/1_xSr05tnvoFOPxkLOM51n2i8WVGf2Hmj/view?usp=sharing"
                        alt="Código QR para descargar la app" class="qr-code">
                </div>

                <div class="download-buttons">
                    <a href="https://drive.google.com/file/d/1_xSr05tnvoFOPxkLOM51n2i8WVGf2Hmj/view?usp=sharing"
                        class="download-btn">
                        <i class="fas fa-download"></i> Descargar APK
                    </a>
                </div>

                <div class="steps-container">
                    <h3 class="steps-title">Cómo Instalar:</h3>
                    <div class="steps">
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">Descarga el archivo APK desde el enlace o escanea el código QR</div>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">Habilita "Orígenes desconocidos" en Ajustes > Seguridad</div>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">Ejecuta el archivo descargado para iniciar la instalación</div>
                        </div>
                        <div class="step">
                            <div class="step-number">4</div>
                            <div class="step-content">Inicia sesión con tus credenciales proporcionadas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Scroll animation for feature items
        document.addEventListener('DOMContentLoaded', function() {
            const featureItems = document.querySelectorAll('.feature-item');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.1
            });

            featureItems.forEach((item, index) => {
                item.style.transitionDelay = `${index * 0.1}s`;
                observer.observe(item);
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>

@endsection