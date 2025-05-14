<?php
session_start();
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $password = trim($_POST['password']);

    if (empty($nombreUsuario) || empty($password)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        $query = "SELECT * FROM usuarios WHERE nombreUsuario = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $nombreUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (password_verify($password, $user['contrasena'])) {
                    $_SESSION['idUsuario'] = $user['idUsuario'];
                    $_SESSION['nombreUsuario'] = $user['nombreUsuario'];
                    $_SESSION['esAdministrador'] = $user['esAdministrador'];
                    header("Location: inicio.php");
                    exit();
                } else {
                    $error = "Contraseña incorrecta.";
                }
            } else {
                $error = "Usuario no encontrado.";
            }

            $stmt->close();
        } else {
            $error = "Error al intentar iniciar sesión.";
        }
    }
}

$conn->close();

include 'header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Iniciar Sesión</h2>
        <form method="POST">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nombreUsuario">Nombre de Usuario</label>
                <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control" maxlength="50" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark btn-block">Iniciar Sesión</button>
            <p class="mt-3 text-center">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
