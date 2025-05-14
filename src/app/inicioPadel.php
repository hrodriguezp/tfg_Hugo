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
        <h1 class="display-4 text-colorPrincipal">Sección de Pádel</h1>
        <p class="lead">¡Bienvenido a la sección de pádel del Club Deportivo! Fomentamos el compañerismo, la agilidad y la técnica en cada entrenamiento y competición.</p>
        <p>Ofrecemos clases y actividades para todos los niveles, desde iniciación hasta avanzado, con entrenadores especializados y pistas modernas para el disfrute de todos los jugadores.</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-6">
            <img src="../../img/equipacionesPadel.png" alt="Equipo de pádel" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-6 d-flex align-items-left">
            <p class="fs-5">Nuestro objetivo es promover un estilo de vida activo y saludable, brindando un entorno ideal tanto para la práctica recreativa como competitiva del pádel. Aquí encontrarás toda la información para empezar o seguir progresando.</p>
        </div>
    </div>

    <div class="text-center mb-4">
        <h3 class="text-dark">¿Qué deseas hacer?</h3>
    </div>

    <div class="row justify-content-center text-center">
        <div class="col-md-4 mb-3">
            <a href="equipoPadel.php" class="btn btn-outline-primary btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-users fa-lg mb-2 d-block"></i>
                Ver Equipos
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="horarioPadel.php" class="btn btn-outline-success btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-calendar-days fa-lg mb-2 d-block"></i>
                Ver Horarios de Entrenamiento
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="reservarPadel.php" class="btn btn-outline-danger btn-lg w-100 py-4 shadow">
                <i class="fa-solid fa-table-tennis-paddle-ball fa-lg mb-2 d-block"></i>
                Reservar Pista de Pádel
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

