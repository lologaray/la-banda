<?php
require_once 'componentes/conexion.php';

$errores = '';
$succes = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {

    $correo = $conexion->real_escape_string($_POST['nombre-usuario'] ?? '');
    $contraseña = $conexion->real_escape_string($_POST['contraseña'] ?? '');

    // Validación de campos vacíos
    if (empty($correo) || empty($contraseña)) {

        $errores .= "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";

    } else {

        // Verificar si el correo ya existe
        $query = $conexion->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->bind_param('s', $correo);
        $query->execute();
        $resultado = $query->get_result();

        if ($resultado->num_rows > 0) {

            $errores .= "<div class='alert alert-danger'>El correo ya está registrado.</div>";

        } else {

            // Registrar usuario
            $contra_hash = password_hash($contraseña, PASSWORD_BCRYPT);
            $query = $conexion->prepare("INSERT INTO usuario (email, contraseña) VALUES (?, ?)");
            $query->bind_param("ss", $correo, $contra_hash);
            $sentencia = $query->execute();

            if ($sentencia) {

                $succes = "
                <div class='alert alert-success'>
                    Registro exitoso.  
                    <a href='login.php' class='alert-link'>Haz clic aquí para iniciar sesión</a>
                </div>";

            } else {
                $errores .= "<div class='alert alert-danger'>Error en la base de datos, pruebe más tarde.</div>";
            }
        }

        $query->close();
        $conexion->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">

    <title>Registro</title>
</head>
<body class="container mt-5">

    <!-- Mostrar errores -->
    <?php if (!empty($errores)) echo $errores; ?>

    <!-- Mostrar éxito -->
    <?php if (!empty($succes)) echo $succes; ?>

    <!-- Formulario de registro -->
    <div class="card p-4 shadow mt-4">
        <h2 class="text-center mb-4">Crear cuenta</h2>

        <form method="POST">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" name="nombre-usuario" id="correo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" class="form-control" required>
            </div>

            <button type="submit" name="ingresar" class="btn btn-primary w-100">Registrarse</button>

            <p class="text-center mt-3">
                ¿Ya tienes cuenta?
                <a href="login.php">Iniciar sesión</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</body>
</html>
