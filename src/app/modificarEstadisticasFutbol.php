<?php
// modificarEstadisticasFutbol.php

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
        $goles = (int)$datos['goles'];
        $asis = (int)$datos['asistencias'];
        $ta = (int)$datos['tarjetasAmarillas'];
        $tr = (int)$datos['tarjetasRojas'];

        // Verificar existencia
        $stmtCheck = $conn->prepare("SELECT idJugador FROM estadisticasfutbol WHERE idJugador = ?");
        $stmtCheck->bind_param("i", $idJugador);
        $stmtCheck->execute();
        $stmtCheck->store_result();

        if ($stmtCheck->num_rows > 0) {
            $stmtUpdate = $conn->prepare("UPDATE estadisticasfutbol SET partidosJugados=?, partidosGanados=?, partidosPerdidos=?, partidosEmpatados=?, goles=?, asistencias=?, tarjetasAmarillas=?, tarjetasRojas=? WHERE idJugador=?");
            $stmtUpdate->bind_param("iiiiiiiii", $pj, $pg, $pp, $pe, $goles, $asis, $ta, $tr, $idJugador);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            $stmtInsert = $conn->prepare("INSERT INTO estadisticasfutbol (idJugador, partidosJugados, partidosGanados, partidosPerdidos, partidosEmpatados, goles, asistencias, tarjetasAmarillas, tarjetasRojas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmtInsert->bind_param("iiiiiiiii", $idJugador, $pj, $pg, $pp, $pe, $goles, $asis, $ta, $tr);
            $stmtInsert->execute();
            $stmtInsert->close();
        }

        $stmtCheck->close();
    }

    // Redirigir tras guardar
    header("Location: jugadoresEquipoFutbol.php?idEquipo=" . urlencode($idEquipo));
    exit;
}

// Obtener jugadores del equipo
$sql = "SELECT j.idJugador, j.nombreCompleto, ef.partidosJugados, ef.partidosGanados, ef.partidosPerdidos, ef.partidosEmpatados, ef.goles, ef.asistencias, ef.tarjetasAmarillas, ef.tarjetasRojas
        FROM jugadores j
        LEFT JOIN estadisticasfutbol ef ON j.idJugador = ef.idJugador
        WHERE j.idEquipo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idEquipo);
$stmt->execute();
$resultado = $stmt->get_result();

include 'header.php';
?>

<div class="container mt-5">
    <h1 class="text-center text-primary">Modificar Estadísticas de Fútbol - Equipo <?= htmlspecialchars($idEquipo) ?></h1>
    <form method="post">
        <table class="table table-bordered mt-4">
            <thead class="table-warning">
                <tr>
                    <th>Nombre</th>
                    <th>PJ</th>
                    <th>PG</th>
                    <th>PP</th>
                    <th>PE</th>
                    <th>Goles</th>
                    <th>Asist.</th>
                    <th>Amarillas</th>
                    <th>Rojas</th>
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
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][goles]" value="<?= (int)$jugador['goles'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][asistencias]" value="<?= (int)$jugador['asistencias'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][tarjetasAmarillas]" value="<?= (int)$jugador['tarjetasAmarillas'] ?>" class="form-control" /></td>
                    <td><input type="number" name="estadisticas[<?= $jugador['idJugador'] ?>][tarjetasRojas]" value="<?= (int)$jugador['tarjetasRojas'] ?>" class="form-control" /></td>
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
