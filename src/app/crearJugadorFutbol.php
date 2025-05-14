<?php
session_start();
require_once 'db.php';

// Verificar que el usuario es admin
if (!isset($_SESSION['nombreUsuario']) || $_SESSION['nombreUsuario'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Obtener el id del equipo desde la URL
$idEquipo = $_GET['idEquipo'] ?? null;

if (!$idEquipo || !is_numeric($idEquipo)) {
    die("ID de equipo no válido.");
}

include 'header.php';
?>

<div class="container py-5">
    <h1 class="text-center text-warning mb-4">Crear Jugador para el Equipo <?= htmlspecialchars($idEquipo) ?></h1>

    <form action="procesarCrearJugador.php" method="POST">
        <input type="hidden" name="idEquipo" value="<?= htmlspecialchars($idEquipo) ?>">

        <div class="form-group">
            <label for="nombreCompleto">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" required>
        </div>

        <div class="form-group">
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
        </div>

        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" class="form-control" id="dni" name="dni" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>

        <div class="form-group">
            <label for="localidad">Localidad:</label>
            <input type="text" class="form-control" id="localidad" name="localidad" required>
        </div>

        <div class="form-group">
            <label for="numeroLicencia">Número de Licencia:</label>
            <input type="text" class="form-control" id="numeroLicencia" name="numeroLicencia" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Jugador</button>
    </form>
</div>

<?php
include 'footer.php';
?>
