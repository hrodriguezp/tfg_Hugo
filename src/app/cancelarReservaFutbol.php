<?php
session_start();
require_once 'db.php'; // Conexión centralizada

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

$idUsuario = $_SESSION['idUsuario'];
$idPista = 1; // Pista de fútbol

// Obtener nombre de la pista
$query = $conn->prepare("SELECT nombrePista FROM pistas WHERE idPista = ?");
$query->bind_param("i", $idPista);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
$nombrePista = $row['nombrePista'] ?? 'Pista';
$query->close();

$diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
$horas = array_merge(
    ['09:00', '10:00', '11:00', '12:00', '13:00', '14:00'],
    ['16:00', '17:00', '18:00', '19:00', '20:00']
);

$horarios = [];
foreach ($diasSemana as $dia) {
    foreach ($horas as $hora) {
        $horarios[$dia][$hora] = ['estado' => 'Libre', 'cancelable' => false];
    }
}

// Obtener horarios ocupados
$query = $conn->prepare("
    SELECT h.dia, h.hora, e.categoria, h.idUsuario
    FROM horarios h
    INNER JOIN equipos e ON h.idEquipo = e.idEquipo
    WHERE e.idPista = ?
");
$query->bind_param("i", $idPista);
$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    $dia = $row['dia'];
    $hora = substr($row['hora'], 0, 5);
    if (isset($horarios[$dia][$hora])) {
        $horarios[$dia][$hora] = [
            'estado' => htmlspecialchars($row['categoria']),
            'cancelable' => ($row['idUsuario'] == $idUsuario)
        ];
    }
}

$query->close();
$conn->close();

include 'header.php';
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Horario de <?= htmlspecialchars($nombrePista) ?></h2>

    <?php if (isset($_GET['cancelado'])): ?>
        <div class="alert alert-success text-center">Reserva cancelada correctamente.</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">No se pudo cancelar la reserva.</div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-sm table-striped table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Hora / Día</th>
                    <?php foreach ($diasSemana as $dia): ?>
                        <th><?= htmlspecialchars($dia) ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horas as $hora): ?>
                    <tr>
                        <td><strong><?= $hora ?></strong></td>
                        <?php foreach ($diasSemana as $dia): ?>
                            <?php
                                $info = $horarios[$dia][$hora];
                                $estado = $info['estado'];
                                $cancelable = $info['cancelable'];
                                $clase = ($estado !== 'Libre') ? 'table-success' : '';
                            ?>
                            <td class="<?= $clase ?>">
                                <?php if ($cancelable): ?>
                                    <button type="button" class="btn btn-sm btn-danger btn-cancel"
                                        data-dia="<?= $dia ?>" data-hora="<?= $hora ?>">
                                        <?= $estado ?>
                                    </button>
                                <?php else: ?>
                                    <?= $estado ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="cancelar_reserva.php" id="cancelForm">
      <input type="hidden" name="dia" id="confirmDia">
      <input type="hidden" name="hora" id="confirmHora">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cancelar Reserva</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que deseas cancelar esta reserva?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="submit" class="btn btn-danger">Sí, cancelar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
    $(document).ready(function() {
        $('.btn-cancel').click(function() {
            $('#confirmDia').val($(this).data('dia'));
            $('#confirmHora').val($(this).data('hora'));
            $('#confirmModal').modal('show');
        });
    });
</script>
