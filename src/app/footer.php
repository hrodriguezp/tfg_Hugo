<footer class="text-center text-lg-start bg-colorSecundario text-dark">
  <div class="container">
    <section>
      <div class="row">

        <!-- Sobre Nosotros -->
        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto pt-3">
          <h6 class="text-uppercase mb-3 font-weight-bold">Club Deportivo María Ana Sanz</h6>
          <p class="small">
            Somos un club comprometido con el deporte y la formación de jóvenes deportistas. Contamos con secciones activas en fútbol, baloncesto y pádel. Nuestro objetivo es fomentar valores como el esfuerzo, el compañerismo y la pasión por el deporte.
          </p>
        </div>

        <!-- Secciones Deportivas -->
        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto pt-3">
          <h6 class="text-uppercase mb-3 font-weight-bold">Secciones</h6>
          <ul class="list-unstyled small">
            <li><a href="#" class="text-dark text-decoration-none">Fútbol</a></li>
            <li><a href="#" class="text-dark text-decoration-none">Baloncesto</a></li>
            <li><a href="#" class="text-dark text-decoration-none">Pádel</a></li>
          </ul>
        </div>

        <!-- Contacto -->
        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto pt-3">
          <h6 class="text-uppercase mb-3 font-weight-bold">Contacto</h6>
          <address class="small">
            <div><i class="fas fa-map-marker-alt me-2"></i> Pamplona, Navarra</div>
            <div><i class="fas fa-envelope me-2"></i> info@cdmasanz.com</div>
            <div><i class="fas fa-phone me-2"></i> +34 948 000 000</div>
          </address>
        </div>

      </div>
    </section>

    <hr class="my-2">

    <!-- Redes Sociales -->
    <section class="text-center mb-2">
      <a href="#" class="text-dark me-3 social-icon"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-dark me-3 social-icon"><i class="fab fa-twitter"></i></a>
      <a href="#" class="text-dark me-3 social-icon"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-dark social-icon"><i class="fab fa-youtube"></i></a>
    </section>

    <!-- Copyright -->
    <section class="pb-3">
      <div class="text-center small">© 2025 Club Deportivo María Ana Sanz. Todos los derechos reservados.</div>
    </section>

    <!-- Cookies -->
    <div id="cookie-banner" class="cookie-banner small mt-3 text-center">
      <p>
        Usamos cookies para mejorar tu experiencia. Al continuar navegando, aceptas nuestra 
        <a href="#" class="text-colorPrincipal text-decoration-underline">Política de Privacidad</a>.
      </p>
      <button id="accept-cookies" class="accept-btn btn btn-sm btn-success mt-1">Aceptar</button>
    </div>
  </div>
</footer>
</body>
</html>

<!-- Estilos personalizados -->
<style>
  .cookie-banner {
    display: none;
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
  }
  .cookie-banner.show {
    display: block;
    opacity: 1;
  }
  .social-icon {
    transition: opacity 0.3s ease;
  }
  .social-icon:hover {
    opacity: 0.7;
    text-decoration: none;
  }
</style>

<!-- Scripts -->
<script>
  window.onload = function () {
    const banner = document.getElementById('cookie-banner');
    if (!localStorage.getItem('cookiesAccepted')) {
      banner.classList.add('show');
    }
    document.getElementById('accept-cookies').addEventListener('click', function () {
      localStorage.setItem('cookiesAccepted', 'true');
      banner.classList.remove('show');
    });
  };
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
