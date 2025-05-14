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
        <h1 class="display-4 text-colorPrincipal">Sección de Fútbol</h1>
        <p class="lead">¡Bienvenido a la sección de fútbol del Club Deportivo! Aquí fomentamos la pasión, el trabajo en equipo y el espíritu deportivo en cada entrenamiento y partido.</p>
        <p>Contamos con equipos en diversas categorías, desde infantil hasta senior, entrenadores titulados y campos equipados para el desarrollo técnico y táctico de nuestros jugadores.</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <img src="../../img/equipacionesFutbol.png" alt="Equipo de fútbol" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6 d-flex align-items-left">
            <p class="fs-5">Nuestro objetivo es formar deportistas comprometidos, responsables y con valores. Ya seas un jugador nuevo, un padre, o un apasionado del fútbol, en esta sección encontrarás toda la información que necesitas para seguir el día a día de nuestros equipos.</p>
        </div>
    </div>

    <div class="text-center mb-4">
        <h3 class="text-dark">¿Qué deseas hacer?</h3>
    </div>

    <div class="row justify-content-center text-center">
        <div class="col-md-4 mb-3">
            <a href="equipoFutbol.php" class="btn btn-outline-primary btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-users fa-lg mb-2 d-block"></i>
                Ver Equipos
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="horarioFutbol.php" class="btn btn-outline-success btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-calendar-days fa-lg mb-2 d-block"></i>
                Ver Horarios de Entrenamiento
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="reservarFutbol.php" class="btn btn-outline-danger btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-futbol fa-lg mb-2 d-block"></i>
                Reservar Campo de Fútbol
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
