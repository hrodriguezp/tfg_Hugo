<?php
require_once 'db.php';

$query = $conn->prepare("SELECT idEquipo, categoria, deporte FROM equipos WHERE LOWER(deporte) = 'fútbol'");
$query->execute();
$resultado = $query->get_result();

include 'header.php'; // Este incluye <html>, <head> y <body>
?>
<?php if (isset($_SESSION['nombreUsuario']) && $_SESSION['nombreUsuario'] === 'admin'): ?>
    <div class="container mt-4 text-right">
        <a href="crearEquipos.php" class="btn btn-success">
            Crear equipo de Fútbol
        </a>
    </div>
<?php endif; ?>

<div class="container py-5">
    <h1 class="mb-4 text-success">Equipos de Fútbol</h1>
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

<script>
    function verJugadores(idEquipo) {
        window.location.href = 'jugadoresEquipoFutbol.php?idEquipo=' + idEquipo;
    }
</script>

<?php include 'footer.php'; // Este cierra </body> y </html> ?>
