<?php 
session_start();
include 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar entradas
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // Validaciones
    if (empty($nombreUsuario) || empty($password) || empty($confirmPassword)) {
        $error = "Todos los campos son obligatorios.";
    } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/\d/', $password)) {
        $error = "La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.";
    } elseif ($password !== $confirmPassword) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el nombre de usuario ya existe
        $query = "SELECT nombreUsuario FROM usuarios WHERE nombreUsuario = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $nombreUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error = "El nombre de usuario ya está en uso.";
            } else {
                // Encriptar la contraseña
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Insertar nuevo usuario con esAdministrador = 0
                $insertQuery = "INSERT INTO usuarios (nombreUsuario, contrasena, esAdministrador) VALUES (?, ?, 0)";
                $insertStmt = $conn->prepare($insertQuery);

                if ($insertStmt) {
                    $insertStmt->bind_param("ss", $nombreUsuario, $hashedPassword);
                    if ($insertStmt->execute()) {
                        // Guardar ID y nombre en sesión
                        $_SESSION['idUsuario'] = $insertStmt->insert_id;
                        $_SESSION['nombreUsuario'] = $nombreUsuario;
                        header("Location: inicio.php");
                        exit();
                    } else {
                        $error = "Error al registrar el usuario.";
                    }
                    $insertStmt->close();
                } else {
                    $error = "Error en la preparación de la consulta.";
                }
            }
            $stmt->close();
        } else {
            $error = "Error en la consulta de verificación.";
        }
    }
}

$conn->close();

include 'header.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4">Formulario de Registro</h2>
        <form method="POST" onsubmit="return validateForm();">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="nombreUsuario">Nombre de Usuario *</label>
                <input type="text" id="nombreUsuario" name="nombreUsuario" class="form-control" maxlength="30" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Contraseña *</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmPassword">Confirmar Contraseña *</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-dark btn-block">Registrarse</button>
            <p class="mt-3 text-center">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    function validateForm() {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;

        if (password.length < 8) {
            alert("La contraseña debe tener al menos 8 caracteres.");
            return false;
        }

        if (!/[A-Z]/.test(password)) {
            alert("La contraseña debe contener al menos una letra mayúscula.");
            return false;
        }

        if (!/\d/.test(password)) {
            alert("La contraseña debe contener al menos un número.");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Las contraseñas no coinciden.");
            return false;
        }

        return true;
    }
</script>
</body>
</html>
