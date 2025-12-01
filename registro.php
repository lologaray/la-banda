<?php
     require_once 'componentes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {
      $errores = '';
      $correo = $conexion->real_escape_string($_POST['nombre-usuario'] ?? '');
      $contraseña = $conexion->real_escape_string($_POST['contraseña'] ?? '');
    
      if (empty($correo) || empty($contraseña)) {
          $errores .= "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
      } else {
        $query = $conexion->prepare("SELECT * FROM usuario WHERE email = ? ");
        $query->bind_param('s', $correo);
        $query->execute();

        if($query->get_result()->num_rows > 0) {
            $errores .= "<div class='alert alert-danger'> El correo ya está registrado.</div>";
        }
        if (empty($errores)) {
            $contra_hash = password_hash($contraseña, PASSWORD_BCRYPT);
            $query = $conexion->prepare('INSERT INTO usuario (email, contraseña) VALUES (?, ?)');
            $query->bind_param( 'ss', $correo, $contra_hash);
            $sentencia = $query->execute();

            $query->close();
            $conexion->close();

            if ($sentencia) {
                $succes = "<div class='alert alert-success'> Registro exitoso. <a href='login.php'>Iniciar sesión</a></div>";
                header("Location: index.php");
            } else {
                $errores .= "<div class='alert alert-danger'> Error en BBD,pruebe mas tarde.</div>";
            }
        
      }
    
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"crossorigin="anonymous">
     <title></title
     >
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


