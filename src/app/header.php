<?php
$administradores = ['admin', 'superuser'];
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['nombreUsuario']);
$username = $isLoggedIn ? $_SESSION['nombreUsuario'] : null;
$esAdmin = $isLoggedIn && in_array($_SESSION['nombreUsuario'], $administradores);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Deportivo</title>

    <link rel="icon" href="../../img/header/logo2.png" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../scss/custom.css">

    <style>
        .nav-link i {
            margin-right: 5px;
            position: relative;
            top: -3px;
        }

        .navbar-nav .nav-link {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            max-height: 50px;
        }

        .navbar {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
    </style>
</head>
<body class="img-fondo">
<!-- Header -->
<header class="bg-colorSecundario fixed-top">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light d-flex justify-content-between">
            <!-- Logo izquierda -->
            <a class="navbar-brand" href="inicio.php">
                <img src="../../img/header/logo.png" alt="Logo">
            </a>

            <!-- Menú colapsable centro -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark font-weight-bold" href="inicio.php">
                            <i class="fa-solid fa-house"></i> INICIO
                        </a>
                    </li>
                    <!-- Nosotros -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" href="#" id="nosotrosDropdown" role="button" data-toggle="dropdown">
                            <i class="fa-solid fa-circle-info"></i> NOSOTROS
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="sobreNosotros.php">Quiénes Somos</a>
                            <a class="dropdown-item" href="contacto.php">Contáctanos</a>
                        </div>
                    </li>
                    <!-- Fútbol -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" href="#" id="futbolDropdown" role="button" data-toggle="dropdown">
                            <i class="fa-solid fa-futbol"></i> FÚTBOL
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="equipoFutbol.php">Ver equipos</a>
                            <a class="dropdown-item" href="horarioFutbol.php">Ver horarios</a>
                            <a class="dropdown-item" href="reservarFutbol.php">Reservar campo</a>
                            <a class="dropdown-item" href="cancelarReservaFutbol.php">Cancelar reserva</a>
                        </div>
                    </li>
                    <!-- Baloncesto -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" href="#" id="baloncestoDropdown" role="button" data-toggle="dropdown">
                            <i class="fa-solid fa-basketball"></i> BALONCESTO
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="equipoBaloncesto.php">Ver equipos</a>
                            <a class="dropdown-item" href="horarioBaloncesto.php">Ver horarios</a>
                            <a class="dropdown-item" href="reservarBaloncesto.php">Reservar campo</a>
                            <a class="dropdown-item" href="cancelarReservaBaloncesto.php">Cancelar reserva</a>
                        </div>
                    </li>
                    <!-- Pádel -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark font-weight-bold" href="#" id="padelDropdown" role="button" data-toggle="dropdown">
                            <i class="fa-solid fa-table-tennis-paddle-ball"></i> PÁDEL
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="equipoPadel.php">Ver equipos</a>
                            <a class="dropdown-item" href="horarioPadel.php">Ver horarios</a>
                            <a class="dropdown-item" href="reservarPadel.php">Reservar pista</a>
                            <a class="dropdown-item" href="cancelarReservaPadel.php">Cancelar reserva</a>
                        </div>
                    </li>
                    <!-- Reservar -->
                    <li class="nav-item">
                        <a class="nav-link text-dark font-weight-bold" href="inicioReserva.php">
                            <i class="fa-solid fa-calendar-check"></i> RESERVAR
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Botón sesión derecha -->
            <div class="d-flex align-items-center">
                <?php if ($isLoggedIn): ?>
                    <span class="navbar-text text-dark mr-3">
                        Bienvenido, <strong><?= htmlspecialchars($username); ?></strong>
                    </span>
                    <a href="logout.php" class="btn btn-outline-dark">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-dark">
                        <i class="fa-solid fa-user"></i> INICIAR SESIÓN
                    </a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

<!-- Espaciador para navbar fijo -->
<div style="margin-top: 100px;"></div>
