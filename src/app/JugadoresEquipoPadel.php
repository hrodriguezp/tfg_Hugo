<?php
// jugadoresEquipoPadel.php

require_once 'db.php';

$idEquipo = $_GET['idEquipo'] ?? null;

if (!$idEquipo || !is_numeric($idEquipo)) {
    die("ID de equipo no válido.");
}

// Consulta de jugadores y estadísticas
$sql = "SELECT j.nombreCompleto, ep.aces, ep.puntosDrive, ep.puntosReves, ep.puntosRemate
        FROM jugadores j
        LEFT JOIN estadisticaspadel ep ON j.idJugador = ep.idJugador
        WHERE j.idEquipo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idEquipo);
$stmt->execute();
$resultado = $stmt->get_result();

include 'header.php';
?>

<style>
    :root {
        --colorPrincipal: #a8e6cf;
        --colorSecundario: #56c596;
    }

    h1 {
        text-align: center;
        color: var(--colorSecundario);
    }

    table {
        width: 90%;
        margin: 0 auto;
        border-collapse: collapse;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        background-color: white;
    }

    th, td {
        border: 1px solid var(--colorPrincipal);
        padding: 12px;
        text-align: center;
    }

    th {
        background-color: var(--colorPrincipal);
        color: #000;
    }

    tr:hover {
        background-color: var(--colorPrincipal);
        cursor: pointer;
    }
</style>

<!-- Botones de acción -->
<div class="d-flex justify-content-center gap-3 mb-4">
    <a href="crearJugadorPadel.php?idEquipo=<?= urlencode($idEquipo) ?>" class="btn btn-success" style="margin-right: 20px;">
        <i class="fas fa-user-plus"></i> Añadir Jugador
    </a>
    <a href="modificarEstadisticasPadel.php?idEquipo=<?= urlencode($idEquipo) ?>" class="btn btn-primary">
        <i class="fas fa-edit"></i> Modificar Estadísticas
    </a>
</div>

<div class="container mt-5">
    <h1 class="text-center text-success mb-4">Jugadores del Equipo de Pádel <?= htmlspecialchars($idEquipo) ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="bg-colorPrincipal text-dark">
                <tr class="text-center">
                    <th>Nombre</th>
                    <th>Aces</th>
                    <th>Puntos Drive</th>
                    <th>Puntos Revés</th>
                    <th>Puntos Remate</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($jugador = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($jugador['nombreCompleto']) ?></td>
                        <td><?= (int)$jugador['aces'] ?></td>
                        <td><?= (int)$jugador['puntosDrive'] ?></td>
                        <td><?= (int)$jugador['puntosReves'] ?></td>
                        <td><?= (int)$jugador['puntosRemate'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include 'footer.php';
$stmt->close();
$conn->close();
?>
