<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} // Iniciar sesión

// Datos de conexión a la base de datos
$servername = "localhost";
$usernameBD = "root";
$BDpassword = "";
$database = "portaldeportivo";

$conn = new mysqli($servername, $usernameBD, $BDpassword, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión. Por favor, intenta nuevamente más tarde.");
}

$error = "";
$ok = "";
