<?php
// modificarEstadisticasPadel.php

require_once 'db.php';

$idEquipo = $_GET['idEquipo'] ?? null;

if (!$idEquipo || !is_numeric($idEquipo)) {
    die("ID de equipo no válido.");
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['estadisticas'])) {
    foreach ($_POST['estadisticas'] as $idJugador => $datos) {
        $pj = (int)$datos['partidosJugados'];
        $pg = (int)$datos['partidosGanados'];
        $pp = (int)$datos['partidosPerdidos'];
        $aces = (int)$datos['aces'];
        $drive = (int)$datos['puntosDrive'];
        $reves = (int)$datos['puntosReves'];
        $remate = (int)$datos['puntosRemate'];

        $stmtCheck = $conn->prepare("SELECT idJugador FROM estadisticaspadel WHERE idJugador = ?");
        $stmtCheck->bind_param("i", $idJugador);
        $stmtCheck->execute();
        $stmtCheck->store_result();

        if ($stmtCheck->num_rows > 0) {
            $stmtUpdate = $conn->prepare("UPDATE estadisticaspadel SET partidosJugados=?, partidosGanados=?, partidosPerdidos=?, aces=?, puntosDrive=?, puntosReves=?, puntosRemate=? WHERE idJugador=?");
            $stmtUpdate->bind_param("iiiiiiii", $pj, $pg, $pp, $aces, $drive, $reves, $remate, $idJugador);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            $stmtInsert = $conn->prepare("INSERT INTO estadisticaspadel (idJugador, partidosJugados, partidosGanados, partidosPerdidos, aces, puntosDrive, puntosReves, puntosRemate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtInsert->bind_param("iiiiiiii", $idJugador, $pj, $pg, $pp, $aces, $drive, $reves, $remate);
            $stmtInsert->execute();
            $stmtInsert->close();
        }

        $stmtCheck->close();
    }

    // Redirigir después de guardar
    header("Location: jugadoresEquipoPadel.php?idEquipo=" . urlencode($idEquipo));
    exit;
}

// Obtener jugadores del equipo
$sql = "SELECT j.idJugador, j.nombreCompleto, ep.partidosJugados, ep.partidosGanados, ep.partidosPerdidos, ep.aces, ep.puntosDrive, ep.puntosReves, ep.puntosRemate
        FROM jugadores j
        LEFT JOIN estadisticaspadel ep ON j.idJugador = ep.idJugador
        WHERE j.idEquipo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idEquipo);
$stmt->execute();
$resultado = $stmt->get_result();

include 'header.php';
?>

<div class="container mt-5">
    <h1 class="text-center text-success">Modificar Estadísticas de Pádel - Equipo <?= htmlspecialchars($idEquipo) ?></h1>
    <form method="post">
        <table class="table table-bordered mt-4">
            <thead class="table-success">
                <tr>
                    <th>Nombre</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PP</th>
                    <th>Aces</th>
                    <th>Drive</th>
                    <th>Revés</th>
                    <th>Remate</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($jugador = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($jugador['nombreCompleto']) ?></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][partidosJugados]" value="<?= (int)$jugador['partidosJugados'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][partidosGanados]" value="<?= (int)$jugador['partidosGanados'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][partidosPerdidos]" value="<?= (int)$jugador['partidosPerdidos'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][aces]" value="<?= (int)$jugador['aces'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][puntosDrive]" value="<?= (int)$jugador['puntosDrive'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][puntosReves]" value="<?= (int)$jugador['puntosReves'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][puntosRemate]" value="<?= (int)$jugador['puntosRemate'] ?>" class="form-control" /></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </div>
    </form>
</div>

<?php
include 'footer.php';
$stmt->close();
$conn->close();
?>
