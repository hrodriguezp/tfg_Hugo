<?php
// inicio.php
include('header.php'); // Asegúrate de que este archivo contenga <!DOCTYPE html>, <html>, <head>, <body>
?>

<main class="container my-2">
    <!-- Bienvenida -->
    <div class="text-center mb-5">
        <h1 class="display-4 font-weight-bold text-colorPrincipal">Club Deportivo María Ana Sanz</h1>
        <p class="lead text-dark">Tu espacio para disfrutar del deporte con pasión y comunidad.</p>
    </div>

    <!-- Secciones destacadas -->
    <div class="row text-center">
        <!-- Fútbol -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow">
                <img src="../../img/inicio/campoFutbol.png" class="card-img-top" alt="Fútbol">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-dark">Fútbol</h5>
                    <p class="card-text">Consulta equipos, horarios y reserva tu campo.</p>
                    <a href="inicioFutbol.php" class="btn btn-colorPrincipal">Explorar</a>
                </div>
            </div>
        </div>

        <!-- Baloncesto -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow">
                <img src="../../img/inicio/pistaBaloncesto.png" class="card-img-top" alt="Baloncesto">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-dark">Baloncesto</h5>
                    <p class="card-text">Horarios, equipos y disponibilidad de cancha.</p>
                    <a href="inicioBaloncesto.php" class="btn btn-colorPrincipal">Explorar</a>
                </div>
            </div>
        </div>

        <!-- Pádel -->
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow">
                <img src="../../img/inicio/pistaPadel.png" class="card-img-top" alt="Pádel">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold text-dark">Pádel</h5>
                    <p class="card-text">Consulta horarios y reserva pista al instante.</p>
                    <a href="inicioPadel.php" class="btn btn-colorPrincipal">Explorar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Noticias -->
    <section class="mt-5">
        <h2 class="text-center text-dark mb-4">Últimas Noticias</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="alert bg-colorSecundario border-left border-colorPrincipal">
                    <h5 class="font-weight-bold"><i class="fa-solid fa-people-group"></i> Nuevo Equipo de Pádel Femenino</h5>
                    <p>El club inaugura su primer equipo femenino de pádel. ¡Ya puedes unirte a los entrenamientos!</p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="alert alert-dark">
                    <h5 class="font-weight-bold"><i class="fa-solid fa-star"></i> Reconocimiento a Nuestro Entrenador</h5>
                    <p>El entrenador Javier Muñoz ha sido premiado como Mejor Técnico Deportivo Local 2025.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('footer.php'); // Aquí se cierran </body> y </html> ?>
