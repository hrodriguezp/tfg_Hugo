<?php
session_start();
if (!isset($_SESSION['nombreUsuario']) || $_SESSION['nombreUsuario'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include 'header.php';
?>

<div class="container py-5">
    <h2 class="mb-4 text-success">Crear nuevo equipo</h2>
    <form action="procesarCrearEquipo.php" method="POST">
        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" required>
        </div>
        <div class="form-group">
            <label for="deporte">Deporte:</label>
            <select class="form-control" id="deporte" name="deporte" required onchange="autocompletarPista()">
                <option value="">Selecciona un deporte</option>
                <option value="Fútbol">Fútbol</option>
                <option value="Baloncesto">Baloncesto</option>
                <option value="Pádel">Pádel</option>
            </select>
        </div>
        <div class="form-group">
            <label for="idPista">ID de la pista:</label>
            <input 
                type="number" 
                class="form-control" 
                id="idPista" 
                name="idPista" 
                required 
                title="1. Campo de fútbol, 2. Pista de baloncesto, 3. Pista de pádel"
                readonly
            >
        </div>
        <button type="submit" class="btn btn-primary mt-3">Crear Equipo</button>
    </form>
</div>

<script>
    function autocompletarPista() {
        const deporte = document.getElementById("deporte").value;
        const idPista = document.getElementById("idPista");

        if (deporte === "Fútbol") {
            idPista.value = 1;
        } else if (deporte === "Baloncesto") {
            idPista.value = 2;
        } else if (deporte === "Pádel") {
            idPista.value = 3;
        } else {
            idPista.value = '';
        }
    }
</script>

<?php include 'footer.php'; ?>
