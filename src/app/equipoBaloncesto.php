<?php
require_once 'db.php'; // Se incluye la conexión centralizada

$resultado = $conn->query("SELECT idEquipo, categoria, deporte FROM equipos WHERE LOWER(deporte) = 'baloncesto'");
?>

<?php include 'header.php'; ?>

<?php if (isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] === 'admin'): ?>
    <div class="container mt-4 text-right">
        <a href="crearEquipos.php" class="btn btn-success">
            Crear equipo de Baloncesto
        </a>
    </div>
<?php endif; ?>
<div class="container py-5">
    <h1 class="mb-4 text-success">Equipos de Baloncesto</h1>
    <div class="equipo-lista">
        <?php while ($equipo = $resultado->fetch_assoc()): ?>
            <div class="equipo p-3 mb-3 border rounded shadow-sm" onclick="verJugadores(<?= $equipo['idEquipo'] ?>)">
                <a href="javascript:void(0)" class="text-decoration-none text-dark">
                    <div><strong>Equipo:</strong> <?= htmlspecialchars($equipo['idEquipo']) ?></div>
                    <div><strong>Categoría:</strong> <?= htmlspecialchars($equipo['categoria']) ?></div>
                    <div><strong>Deporte:</strong> <?= htmlspecialchars($equipo['deporte']) ?></div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

    <?php include 'footer.php'; ?>
    <script>
        function verJugadores(idEquipo) {
            window.location.href = 'jugadoresEquipoBaloncesto.php?idEquipo=' + idEquipo;
        }
    </script>
