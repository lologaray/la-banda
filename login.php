
<?php
require_once 'componentes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {
    $errores = '';
    $correo = $_POST['nombre-usuario'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if (empty($correo) || empty($contraseña)) {
        $errores .= "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
    } else {
        $frase = $conexion->prepare("SELECT * FROM usuario WHERE email = ?");
        $frase->bind_param("s", $correo);
        $frase->execute();

        $usuario = $frase->get_result()->fetch_assoc();

        if ($usuario) {
            if (password_verify($contraseña, $usuario['contraseña'])) {
                session_start();
                $_SESSION['userid'] = $usuario['id_usuario'];
                $_SESSION['rol'] = $usuario['rol'];
                $_SESSION['nombre'] = $usuario['nombre'];

                $conexion->close();
                header("Location: index.php");
                exit();
            } else {
                $errores .= "<div class='alert alert-danger'>Correo o contraseña incorrecta.</div>";
            }
        } else {
            $errores .= "<div class='alert alert-danger'>Correo o contraseña incorrecta.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>AGENCIA DE VIAJE - LOGIN</title>
</head>
<body>
    <form method="POST" action="login.php">
        <?php require_once 'componentes/comp-form-login.php'; ?>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<body>
    <form method="POST" action="login.php">
        <?php require_once 'componentes/comp-form-login.php';?>

        <input type="submit" value="ingresar" name="ingresar" id="ingresar">

    </form>

    <div>
        <p>¿No tenes un USUARIO?resgistrate aqui: <a href="resgistro.php">Aqui</a></p>
    </div>

</body>

</html>
