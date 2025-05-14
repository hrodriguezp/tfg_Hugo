<?php
session_start();
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}
include 'header.php';
?>

<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="display-4 text-colorPrincipal">Sección de Baloncesto</h1>
        <p class="lead">¡Bienvenido a la sección de baloncesto del Club Deportivo! Aquí promovemos la pasión por el juego, el trabajo en equipo y la superación personal en cada entrenamiento y partido.</p>
        <p>Disponemos de equipos en diferentes categorías, desde base hasta senior, con entrenadores cualificados y recursos que garantizan el desarrollo técnico, físico y táctico de nuestros jugadores.</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <img src="../../img/equipacionesBaloncesto.png" alt="Equipo de baloncesto" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6 d-flex align-items-left">
            <p class="fs-5">Nuestro objetivo es formar jugadores comprometidos, disciplinados y con grandes valores deportivos. Si eres jugador, familiar o amante del baloncesto, esta sección te ofrece toda la información sobre nuestros equipos y actividades.</p>
        </div>
    </div>

    <div class="text-center mb-4">
        <h3 class="text-dark">¿Qué deseas hacer?</h3>
    </div>

    <div class="row justify-content-center text-center">
        <div class="col-md-4 mb-3">
            <a href="equipoBaloncesto.php" class="btn btn-outline-primary btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-users fa-lg mb-2 d-block"></i>
                Ver Equipos
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="horarioBaloncesto.php" class="btn btn-outline-success btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-calendar-days fa-lg mb-2 d-block"></i>
                Ver Horarios de Entrenamiento
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="reservarBaloncesto.php" class="btn btn-outline-danger btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-basketball fa-lg mb-2 d-block"></i>
                Reservar Pista de Baloncesto
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

