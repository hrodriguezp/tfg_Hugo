<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Obtener el id del equipo desde la URL
$idEquipo = $_GET['idEquipo'] ?? null;

if (!$idEquipo || !is_numeric($idEquipo)) {
    die("ID de equipo no válido.");
}

// Preparar la consulta para obtener las estadísticas de los jugadores
$sql = "SELECT j.nombreCompleto, eb.puntosAnotados, eb.asistencias, eb.porcentajeTres, eb.porcentajeDos
        FROM jugadores j
        LEFT JOIN estadisticasbaloncesto eb ON j.idJugador = eb.idJugador
        WHERE j.idEquipo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idEquipo);
$stmt->execute();
$resultado = $stmt->get_result();

include("header.php");
?>

<style>
    :root {
        --colorPrincipal: #fcd56c;
        --colorSecundario: #d48a07;
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
        <a href="crearJugadorBaloncesto.php?idEquipo=<?= urlencode($idEquipo) ?>" class="btn btn-success" style="margin-right: 20px;">
            <i class="fas fa-user-plus"></i> Añadir Jugador
        </a>
        <a href="modificarEstadisticasFutbol.php?idEquipo=<?= urlencode($idEquipo) ?>" class="btn btn-primary">
            <i class="fas fa-edit"></i> Modificar Estadísticas
        </a>
    </div>
<div class="container mt-5">
    <h1 class="text-center text-warning mb-4">Jugadores del Equipo de Baloncesto <?= htmlspecialchars($idEquipo) ?></h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="bg-colorPrincipal text-dark">
                <tr class="text-center">
                    <th>Nombre</th>
                    <th>Puntos</th>
                    <th>Asistencias</th>
                    <th>% Tiros de 3</th>
                    <th>% Tiros de 2</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($jugador = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($jugador['nombreCompleto']) ?></td>
                        <td><?= $jugador['puntosAnotados'] ?></td>
                        <td><?= $jugador['asistencias'] ?></td>
                        <td><?= $jugador['porcentajeTres'] ?>%</td>
                        <td><?= $jugador['porcentajeDos'] ?>%</td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("footer.php");

// Cerrar recursos
$stmt->close();
$conn->close();
?>
