<?php
// modificarEstadisticasBaloncesto.php

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
        $pe = (int)$datos['partidosEmpatados'];
        $puntos = (int)$datos['puntosAnotados'];
        $asis = (int)$datos['asistencias'];
        $tres = (float)$datos['porcentajeTres'];
        $dos = (float)$datos['porcentajeDos'];

        $stmtCheck = $conn->prepare("SELECT idJugador FROM estadisticasbaloncesto WHERE idJugador = ?");
        $stmtCheck->bind_param("i", $idJugador);
        $stmtCheck->execute();
        $stmtCheck->store_result();

        if ($stmtCheck->num_rows > 0) {
            $stmtUpdate = $conn->prepare("UPDATE estadisticasbaloncesto SET partidosJugados=?, partidosGanados=?, partidosPerdidos=?, partidosEmpatados=?, puntosAnotados=?, asistencias=?, porcentajeTres=?, porcentajeDos=? WHERE idJugador=?");
            $stmtUpdate->bind_param("iiiiiiddi", $pj, $pg, $pp, $pe, $puntos, $asis, $tres, $dos, $idJugador);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            $stmtInsert = $conn->prepare("INSERT INTO estadisticasbaloncesto (idJugador, partidosJugados, partidosGanados, partidosPerdidos, partidosEmpatados, puntosAnotados, asistencias, porcentajeTres, porcentajeDos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtInsert->bind_param("iiiiiiddd", $idJugador, $pj, $pg, $pp, $pe, $puntos, $asis, $tres, $dos);
            $stmtInsert->execute();
            $stmtInsert->close();
        }

        $stmtCheck->close();
    }

    // Redirección
    header("Location: jugadoresEquipoBaloncesto.php?idEquipo=" . urlencode($idEquipo));
    exit;
}

// Obtener jugadores
$sql = "SELECT j.idJugador, j.nombreCompleto, eb.partidosJugados, eb.partidosGanados, eb.partidosPerdidos, eb.partidosEmpatados, eb.puntosAnotados, eb.asistencias, eb.porcentajeTres, eb.porcentajeDos
        FROM jugadores j
        LEFT JOIN estadisticasbaloncesto eb ON j.idJugador = eb.idJugador
        WHERE j.idEquipo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idEquipo);
$stmt->execute();
$resultado = $stmt->get_result();

include 'header.php';
?>

<div class="container mt-5">
    <h1 class="text-center text-primary">Modificar Estadísticas de Baloncesto - Equipo <?= htmlspecialchars($idEquipo) ?></h1>
    <form method="post">
        <table class="table table-bordered mt-4">
            <thead class="table-warning">
                <tr>
                    <th>Nombre</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PP</th>
                    <th>PE</th>
                    <th>Puntos</th>
                    <th>Asistencias</th>
                    <th>% T3</th>
                    <th>% T2</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($jugador = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($jugador['nombreCompleto']) ?></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][partidosJugados]" value="<?= (int)$jugador['partidosJugados'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][partidosGanados]" value="<?= (int)$jugador['partidosGanados'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][partidosPerdidos]" value="<?= (int)$jugador['partidosPerdidos'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][partidosEmpatados]" value="<?= (int)$jugador['partidosEmpatados'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][puntosAnotados]" value="<?= (int)$jugador['puntosAnotados'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][asistencias]" value="<?= (int)$jugador['asistencias'] ?>" class="form-control" /></td>
                    <td><input type="number" step="0.01" name="estadisticas[<?= $jugador['idJugador'] ?>][porcentajeTres]" value="<?= (float)$jugador['porcentajeTres'] ?>" class="form-control" /></td>
                    <td><input type="number" step="0.01" name="estadisticas[<?= $jugador['idJugador'] ?>][porcentajeDos]" value="<?= (float)$jugador['porcentajeDos'] ?>" class="form-control" /></td>
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
