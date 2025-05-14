<?php include 'header.php'; ?>

<div class="container my-5">
    <h2 class="text-center mb-4">Reservar Instalación Deportiva</h2>

    <div class="row g-4 justify-content-center">

        <!-- Fútbol -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="../../img/inicio/campoFutbol.png" class="card-img-top" alt="Campo de Fútbol"> <!-- Cambia ruta según tu imagen -->
                <div class="card-body text-center">
                    <h5 class="card-title">Fútbol</h5>
                    <p class="card-text">Reserva tu campo de fútbol para entrenamientos o partidos.</p>
                    <a href="reservarFutbol.php" class="btn btn-success w-100">Reservar Fútbol</a>
                </div>
            </div>
        </div>

        <!-- Baloncesto -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="../../img/inicio/pistaBaloncesto.png" class="card-img-top" alt="Cancha de Baloncesto"> <!-- Cambia ruta según tu imagen -->
                <div class="card-body text-center">
                    <h5 class="card-title">Baloncesto</h5>
                    <p class="card-text">Reserva tu cancha de baloncesto para tus encuentros.</p>
                    <a href="reservarBaloncesto.php" class="btn btn-warning w-100">Reservar Baloncesto</a>
                </div>
            </div>
        </div>

        <!-- Pádel -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="../../img/inicio/pistaPadel.png" class="card-img-top" alt="Pista de Pádel"> <!-- Cambia ruta según tu imagen -->
                <div class="card-body text-center">
                    <h5 class="card-title">Pádel</h5>
                    <p class="card-text">Reserva tu pista de pádel de forma rápida y sencilla.</p>
                    <a href="reservarPadel.php" class="btn btn-primary w-100">Reservar Pádel</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>
