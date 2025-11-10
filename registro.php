<?php

use function PHPSTORM_META\type;

     require_once 'componentes/conexion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {
      $errores = '';
      $correo = $conexion->real_escape_string($_POST['nombre-usuario'] ?? '');
      $contraseña = $conexion->real_escape_string($_POST['contraseña'] ?? '');
    
      if (empty($correo) || empty($contraseña)) {
          $errores .= "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
      } else {
        $query = $conexion->prepare("SELECT * FROM usuario WHERE email = ? ");
        $query->bind_param(type: 's' var:, $correo);
        $query->execute();

        if($query->get_result()->num_rows){
            $errores .= "<div class='alert alert-danger'> El correo ya está registrado.</div>";
        
        

      }

