<?php
session_start();
require_once 'db.php';

// Verificar que el usuario es admin
if (!isset($_SESSION['nombreUsuario']) || $_SESSION['nombreUsuario'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria = trim($_POST['categoria']);
    $deporte = strtolower(trim($_POST['deporte']));
    $idPista = intval($_POST['idPista']);

    if (empty($categoria) || empty($deporte) || empty($idPista)) {
        die("Todos los campos son obligatorios.");
    }

    $query = "INSERT INTO equipos (categoria, deporte, idPista) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssi", $categoria, $deporte, $idPista);
        if ($stmt->execute()) {
            // Redirigir dinámicamente según el deporte
            switch ($deporte) {
                case 'fútbol':
                case 'futbol': // por si viene sin tilde
                    $redirect = "equipoFutbol.php";
                    break;
                case 'baloncesto':
                    $redirect = "equipoBaloncesto.php";
                    break;
                case 'padel':
                case 'pádel':
                    $redirect = "equipoPadel.php";
                    break;
            }

            header("Location: " . urlencode($redirect));
            exit();
        } else {
            echo "Error al crear el equipo: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    header("Location: crearEquipos.php");
    exit();
}
?>
