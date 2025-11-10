<?php
  require_once 'componente/conexion.php';
  
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {
      $errores = '';
      $correo = $conexion->real_escape_string($_POST['nombre-usuario'] ?? '');
      $contraseña = $conexion->real_escape_string($_POST['contraseña'] ?? '');
    
      if (empty($correo) || empty($contraseña)) {
          $errores .= "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
      } else {
        $frase = $conexion->prepare(query: "SELECT* FROM usuario WHERE usuario.email = ? ");
        $frase->bind_param(types: "s", $correo);
        $frase->execute();

        $usuario = $frase->get_result()->fetch_assoc();

        if($usuario){
            if(password_verify($contraseña, $usuario['contraseña'])){
                session_start();
                $_SESSION['userid'] = $usuario['id_usuario'];
                $_SESSION['rol'] = $usuario['rol'];
                $_SESSION['nombre'] = $usuario['nombre'];

                $conexion->close();

                header(location: 'index.php');
                exit();
            } else {
                $errores .= "<div class='alert alert-danger'> correo o contraseña incorrecta.</div";
            }
        } else {
            $errores .= "<div class='alert alert-danger'> correo o contraseña incorrecta.</div";
        }
              
  }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>AGENCIA DE VIAJE - LOGIN</title>
</head>
<body>
    <form method="POST" action="login.php">
        
    </form>
     <?php require_once 'componentes/comp-form-ligin.php'; ?>

    <div>
        <p>¿no tienes usuario? Registrate: <a href="registro.php">aquí></a></p>    
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>