<?php
// Incluir el archivo de conexión a la base de datos
require_once 'db.php';

// Obtener el id de la pista (en este caso idPista = 3)
$idPista = 3; // Cambiar esto para que sea la pista con idPista = 3

// Obtener el nombre de la pista
$query = $conn->prepare("SELECT nombrePista FROM pistas WHERE idPista = ?");
$query->bind_param("i", $idPista);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
$nombrePista = $row['nombrePista'];
$query->close();

// Días de la semana
$diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

// Horas: 09:00–14:00 y 16:00–20:00
$horas = array_merge(
    ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'],
    ['16:00', '17:00', '18:00', '19:00', '20:00']
);

// Inicializar la estructura con todo en "Libre"
$horarios = [];
foreach ($diasSemana as $dia) {
    foreach ($horas as $hora) {
        $horarios[$dia][$hora] = 'Libre';
    }
}

// Obtener horarios ocupados desde la BD
$query = $conn->prepare("
    SELECT h.dia, h.hora, e.categoria
    FROM horarios h
    INNER JOIN equipos e ON h.idEquipo = e.idEquipo
    WHERE e.idPista = ?
");
$query->bind_param("i", $idPista);
$query->execute();
$result = $query->get_result();

// Actualizar la tabla con los horarios ocupados
while ($row = $result->fetch_assoc()) {
    $dia = $row['dia'];
    $hora = substr($row['hora'], 0, 5); // recorta a HH:MM
    if (isset($horarios[$dia][$hora])) {
        $horarios[$dia][$hora] = htmlspecialchars($row['categoria']);
    }
}

$query->close();
$conn->close();

// Incluir encabezado HTML
include 'header.php';
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Horario de <?= htmlspecialchars($nombrePista) ?></h2>

    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Hora / Día</th>
                    <?php foreach ($diasSemana as $dia): ?>
                        <th><?= $dia ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horas as $hora): ?>
                    <tr>
                        <td><strong><?= $hora ?></strong></td>
                        <?php foreach ($diasSemana as $dia): ?>
                            <?php
                                $estado = $horarios[$dia][$hora];
                                $clase = ($estado !== 'Libre') ? 'table-success' : '';
                            ?>
                            <td class="<?= $clase ?>"><?= $estado ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>

