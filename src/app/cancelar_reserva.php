<?php
require_once 'db.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];
    $idUsuario = $_SESSION['idUsuario'];

    $stmt = $conn->prepare("DELETE FROM horarios WHERE dia = ? AND hora = ? AND idUsuario = ?");
    $stmt->bind_param("ssi", $dia, $hora, $idUsuario);

    $referer = $_SERVER['HTTP_REFERER'] ?? 'javascript:history.back()';

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        header("Location: $referer?cancelado=1");
    } else {
        header("Location: $referer?error=1");
    }

    $stmt->close();
    $conn->close();
}
?>
