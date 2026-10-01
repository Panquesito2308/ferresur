@extends('layouts.app-master')

@section('content')

<head>
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
</head>

<body>
  <div class="hero-section">
    <video class="background-video" autoplay loop muted playsinline>
      <source src="{{ asset('img/banners/fondo.mp4') }}" type="video/mp4">
      Tu navegador no soporta el formato de video.
    </video>

    <div class="content">
      <h1>
        Líderes en el <span class="highlight-orange">sector ferretero</span> respaldados
        por años de experiencia y un equipo sólido y comprometido.<br>
      </h1>
      <p>
        En cada proyecto, nuestra fortaleza y dedicación son tu mejor garantía.
      </p>
      <a href="/ventas_mayoreo" class="mi-boton">COTIZAR AHORA</a>
    </div>
  </div>

  <div class="contai">
    <div class="conte">
      <span class="high">NUESTROS PRODUCTOS</span>
      <h2 class="ti">Descubre nuestra lista de productos, clasificados por categorías para una mejor experiencia para ti</h2>
      <p>
      <div class="des">
        Nuestros productos son ideal para tus proyectos de construcción y mantenimiento
        </p>
      </div>
      <a href="/obra_negra" class=" mi-boton">COTIZAR AHORA</a>
    </div>
  </div>


  <br><br><br><br>
  <h1 class="t1">¿Qué Ofrecemos?</h1>
  <div class="tarjeta-contenedor">
    <div class="tarjeta">
      <img src="{{ asset('img/icons/delivery.png') }}" alt="Envío Gratuito">
      <h3>Envío Gratuito</h3>
      <p>Garantizamos entregas gratuitas y puntuales dentro de la ciudad. Nuestra logística eficiente asegura que tus materiales lleguen a tiempo.</p>
    </div>
    <div class="tarjeta">
      <img src="{{ asset('img/icons/products.png') }}" alt="Productos Confiables">
      <h3>Productos Confiables</h3>
      <p>Ofrecemos productos confiables de las marcas líderes en el sector. Nuestra amplia gama asegura durabilidad y resistencia.</p>
    </div>
    <div class="tarjeta">
      <img src="{{ asset('img/icons/support.png') }}" alt="Soporte">
      <h3>Soporte</h3>
      <p>Más de 30 años de experiencia respaldando tus proyectos. Asesoramiento experto para maximizar el éxito de tu obra.</p>
    </div>
    <div class="tarjeta">
      <img src="{{ asset('img/icons/payment.png') }}" alt="Pago Seguro">
      <h3>Pago Seguro</h3>
      <p>Tus pagos están 100% protegidos y respaldados. Contamos con stock garantizado de materiales para construcción.</p>
    </div>
  </div>

  <section class="event-register">
    <div class="event-register-content">
      <div class="event-image">
        <img src="{{ asset('img/banners/evento.png') }}" alt="Eventos Exclusivos">
      </div>
      <div class="event-text">
        <h2>No te pierdas nuestros eventos exclusivos</h2>
        <p>Regístrate ahora y obtén acceso a contenido único, promociones especiales y la oportunidad de conectar con expertos en el sector.</p>
        <a href="/register" class="register-button">Regístrate gratis</a>
      </div>
    </div>
  </section>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h2 class="mb-4">Opiniones de Clientes</h2>
        <p class="lead">Lo que nuestros clientes dicen sobre nosotros</p>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-4 mb-4 opinion-card" data-opinion="1">
        <div class="card h-100">
          <div class="card-body">
            <p class="card-text">"Siempre encuentro todo lo que necesito, gracias a su amplio stock y excelente atención. Son una empresa seria y confiable, ideal para proyectos de cualquier tamaño."</p>
          </div>
          <div class="card-footer text-center">
            <h5 class="card-title mb-0">Juan Pérez</h5>
            <small class="text-muted">Constructor</small>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4 opinion-card" data-opinion="2">
        <div class="card h-100">
          <div class="card-body">
            <p class="card-text">"Una empresa con trayectoria sólida, siempre preparada para cubrir nuestras necesidades. Su compromiso y capacidad logística hacen la diferencia en cada proyecto."</p>
          </div>
          <div class="card-footer text-center">
            <h5 class="card-title mb-0">María López</h5>
            <small class="text-muted">Arquitecta</small>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4 opinion-card" data-opinion="3">
        <div class="card h-100">
          <div class="card-body">
            <p class="card-text">"Es un gusto trabajar con un equipo tan profesional y comprometido. Siempre tienen disponibilidad de materiales y una respuesta inmediata para nuestros proyectos."</p>
          </div>
          <div class="card-footer text-center">
            <h5 class="card-title mb-0">Carlos García</h5>
            <small class="text-muted">Electricista</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="area-marcas py-5 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center mb-4">
          <div class="titulo-seccion">
            <h1>Marcas Aliadas</h1>
            <p>Estamos orgullosos de colaborar con algunas de las marcas más reconocidas en la industria.</p>
          </div>
        </div>
      </div>

      <div id="carruselMarcas" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row justify-content-center">
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/foset.png') }}" class="img-fluid opacity-50" alt="Foset">
              </div>
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/png-clipart-philips-logo-wordmark-brand-lg-miscellaneous-blue.png') }}" class="img-fluid opacity-50" alt="Philips">
              </div>
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/Pretul.jpg') }}" class="img-fluid opacity-50" alt="Pretul">
              </div>
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/images.png') }}" class="img-fluid opacity-50" alt="Rotoplas">
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/Fiero_logo.jpg') }}" class="img-fluid opacity-50" alt="Fiero">
              </div>
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/logos-marcas-image91.png') }}" class="img-fluid opacity-50" alt="Austromex">
              </div>
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/383-640w.png') }}" class="img-fluid opacity-50" alt="Bioplas">
              </div>
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/png-clipart-logo-makita-brand-graphics-makita-cdr-company-thumbnail.png') }}" class="img-fluid opacity-50" alt="Makita">
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row justify-content-center">
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/DEACERO-LOGO.png') }}" class="img-fluid opacity-50" alt="Deacero">
              </div>
              <div class="col-4 col-md-2">
                <img src="{{ asset('img/multimedia/carrousel/cuervo.png') }}" class="img-fluid opacity-50" alt="Cuervo">
              </div>
            </div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carruselMarcas" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselMarcas" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      </div>
    </div>
  </section>

</body>
<style>
  /* Carrusel */
  .carousel-item img {
    width: 100%;
    /* Hacer que las imágenes se adapten al ancho del contenedor */
    height: auto;
    /* Mantener las proporciones de las imágenes */
    max-width: 150px;
    /* Tamaño máximo para que no se deformen */
    opacity: 0.5;
    /* Aplica la opacidad inicial */
    transition: opacity 0.3s ease;
    /* Transición suave para el cambio de opacidad */
    object-fit: contain;
    /* Asegura que las imágenes se ajusten sin deformarse */
  }

  /* Efecto cuando el ratón pasa sobre la imagen */
  .carousel-item img:hover {
    opacity: 1 !important;
    /* Restaura la opacidad al pasar el ratón */
  }

  .carousel-item .col-6,
  .carousel-item .col-md-2 {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .opinion-card {
    cursor: pointer;
    transition: transform 0.3s ease;
  }

  .opinion-card:hover {
    transform: scale(1.05);
  }

  .opinion-card.active {
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
</style>


<script>
  window.addEventListener('scroll', () => {
    const video = document.querySelector('.background-video');
    let scrollPosition = window.scrollY;
    video.style.transform = `translateY(${scrollPosition * 0.5}px)`; // Efecto parallax
  });
  document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.custom-carousel');
    const prevButton = document.querySelector('.custom-prev-slide');
    const nextButton = document.querySelector('.custom-next-slide');
    const slideWidth = document.querySelector('.custom-carousel-item').offsetWidth;

    let scrollAmount = 0;

    prevButton.addEventListener('click', () => {
      scrollAmount -= slideWidth;
      if (scrollAmount < 0) {
        scrollAmount = 0;
      }
      carousel.scrollTo({
        left: scrollAmount,
        behavior: 'smooth'
      });
    });

    nextButton.addEventListener('click', () => {
      scrollAmount += slideWidth;
      if (scrollAmount > carousel.scrollWidth - carousel.clientWidth) {
        scrollAmount = carousel.scrollWidth - carousel.clientWidth;
      }
      carousel.scrollTo({
        left: scrollAmount,
        behavior: 'smooth'
      });
    });
  });

  $(document).ready(function() {
    $('.opinion-card').click(function() {
      $('.opinion-card').removeClass('active');
      $(this).addClass('active');
    });

    $(window).scroll(function() {
      $('.opinion-card').each(function() {
        var position = $(this).offset().top;
        var scroll = $(window).scrollTop();
        var windowHeight = $(window).height();

        if (position < scroll + windowHeight - 100) {
          $(this).addClass('animate__animated animate__fadeInUp');
        }
      });
    });
  });
</script>


@endsection