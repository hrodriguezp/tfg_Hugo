<?php
session_start();

// Redirigir si no está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
require_once 'db.php';

$idUsuario = $_SESSION['idUsuario'];
$mensaje = "";
$tipoMensaje = "";

// Procesar la reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idEquipo = $_POST['idEquipo'];
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];

    // Validación: comprobar si se seleccionó un equipo
    if (empty($idEquipo)) {
        $mensaje = "Por favor, selecciona un equipo antes de confirmar la reserva.";
        $tipoMensaje = "danger";
    } else {
        // Verificar si ya está reservada la pista en ese horario
        $stmt = $conn->prepare("
            SELECT h.idHorario
            FROM horarios h
            INNER JOIN equipos e ON h.idEquipo = e.idEquipo
            WHERE e.idPista = (SELECT idPista FROM equipos WHERE idEquipo = ?)
            AND h.dia = ? AND h.hora = ?
        ");
        $stmt->bind_param("iss", $idEquipo, $dia, $hora);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $mensaje = "La pista ya está reservada en ese horario.";
            $tipoMensaje = "danger";
        } else {
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO horarios (idEquipo, idUsuario, dia, hora) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $idEquipo, $idUsuario, $dia, $hora);
            if ($stmt->execute()) {
                $mensaje = "Reserva realizada correctamente.";
                $tipoMensaje = "success";
            } else {
                $mensaje = "Error al realizar la reserva.";
                $tipoMensaje = "danger";
            }
        }

        $stmt->close();
    }
}

// Obtener los equipos de fútbol para el formulario
$resultEquipos = $conn->query("
    SELECT idEquipo, categoria 
    FROM equipos 
    WHERE LOWER(deporte) = 'futbol'
");

// Días y horas disponibles
$diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
$horas = ['09:00','10:00','11:00','12:00','13:00','14:00','16:00','17:00','18:00','19:00','20:00'];

include 'header.php';
?>

<div class="container my-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Reservar Campo de Fútbol</h2>

            <!-- Mensaje de confirmación o error -->
            <?php if (!empty($mensaje)): ?>
                <div class="alert alert-<?= $tipoMensaje ?> text-center"><?= htmlspecialchars($mensaje) ?></div>
            <?php endif; ?>

            <!-- Formulario para reservar -->
            <form method="POST" novalidate>
                <div class="mb-3">
                    <label for="idEquipo" class="form-label">Equipo</label>
                    <select name="idEquipo" id="idEquipo" class="form-select" required>
                        <option value="">Selecciona un equipo</option>
                        <?php while ($equipo = $resultEquipos->fetch_assoc()): ?>
                            <option value="<?= $equipo['idEquipo'] ?>">
                                Equipo <?= $equipo['idEquipo'] ?> - <?= $equipo['categoria'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="dia" class="form-label">Día</label>
                    <select name="dia" id="dia" class="form-select" required>
                        <?php foreach ($diasSemana as $dia): ?>
                            <option value="<?= $dia ?>"><?= $dia ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="hora" class="form-label">Hora</label>
                    <select name="hora" id="hora" class="form-select" required>
                        <?php foreach ($horas as $hora): ?>
                            <option value="<?= $hora ?>"><?= $hora ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning w-100">Confirmar Reserva</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
$conn->close();
?>
