<?php
// crearJugadorPadel.php

require_once 'db.php';

$idEquipo = $_GET['idEquipo'] ?? null;

if (!$idEquipo || !is_numeric($idEquipo)) {
    die("ID de equipo no válido.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombreCompleto'] ?? '';
    $fecha = $_POST['fechaNacimiento'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $direccion = $_POST['direccion'] ?? null;
    $localidad = $_POST['localidad'] ?? null;
    $licencia = $_POST['numeroLicencia'] ?? null;

    if ($nombre && $fecha && $dni) {
        $stmt = $conn->prepare("INSERT INTO jugadores (nombreCompleto, fechaNacimiento, dni, direccion, localidad, numeroLicencia, idEquipo) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $nombre, $fecha, $dni, $direccion, $localidad, $licencia, $idEquipo);
        $stmt->execute();
        $stmt->close();

        header("Location: jugadoresEquipoPadel.php?idEquipo=" . urlencode($idEquipo));
        exit;
    } else {
        $error = "Por favor, complete todos los campos obligatorios.";
    }
}

include 'header.php';
?>

<div class="container mt-5">
    <h1 class="text-center text-success">Añadir Jugador al Equipo de Pádel</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" class="mt-4">
        <div class="mb-3">
            <label class="form-label">Nombre Completo *</label>
            <input type="text" name="nombreCompleto" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Nacimiento *</label>
            <input type="date" name="fechaNacimiento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">DNI *</label>
            <input type="text" name="dni" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Localidad</label>
            <input type="text" name="localidad" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Número de Licencia</label>
            <input type="text" name="numeroLicencia" class="form-control">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Guardar Jugador</button>
            <a href="jugadoresEquipoPadel.php?idEquipo=<?= urlencode($idEquipo) ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<?php
include 'footer.php';
$conn->close();
?>
