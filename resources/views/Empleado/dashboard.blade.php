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
              <h1>Bienvenido, {{ auth()->user()->empleado->nombre }} {{ auth()->user()->empleado->apellidos }}</h1>
          </div>
      </div>

      <div class="conten">
          <p>Este es el panel de empleado donde puedes ver tus tareas y desempeño.</p>
      </div>


  </body>
  <style>
      .conten {
          background-color: #f8f9fa;
          padding: 60px 20px;
          font-size: 1.5rem;
          text-align: center;

      }
  </style>
  @endsection