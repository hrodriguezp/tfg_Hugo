<?php
session_start();
require_once 'db.php';

// Verificar que el usuario es admin
if (!isset($_SESSION['nombreUsuario']) || $_SESSION['nombreUsuario'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Verificar que los datos del formulario han sido enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombreCompleto = trim($_POST['nombreCompleto']);
    $fechaNacimiento = trim($_POST['fechaNacimiento']);
    $dni = trim($_POST['dni']);
    $direccion = trim($_POST['direccion']);
    $localidad = trim($_POST['localidad']);
    $numeroLicencia = trim($_POST['numeroLicencia']);
    $idEquipo = intval($_POST['idEquipo']);

    // Validar que los campos no estén vacíos
    if (empty($nombreCompleto) || empty($fechaNacimiento) || empty($dni) || empty($direccion) || empty($localidad) || empty($numeroLicencia)) {
        die("Todos los campos son obligatorios.");
    }

    // Preparar consulta para insertar el nuevo jugador
    $query = "INSERT INTO jugadores (nombreCompleto, fechaNacimiento, dni, direccion, localidad, numeroLicencia, idEquipo) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("ssssssi", $nombreCompleto, $fechaNacimiento, $dni, $direccion, $localidad, $numeroLicencia, $idEquipo);

        if ($stmt->execute()) {
            // Redirigir al listado de jugadores de ese equipo o a una página de éxito
            header("Location: jugadoresEquipoFutbol.php?idEquipo=" . $idEquipo . "&mensaje=Jugador creado correctamente");
            exit();
        } else {
            echo "Error al crear el jugador: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    die("Acceso no permitido.");
}
?>
