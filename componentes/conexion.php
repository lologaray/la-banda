<?php
$servidor = "localhots";
$usuario = "root";
$contrasenia = "";
$base_datos = "agencia";

//Create conexion
$conexion = new mysqli(hostname: $servidor, username: $usuario, password: $contrasenia,database: $base_datos);


//check connection
if ($conexion->connect_error) {
    die("Error de conexion:  "  . $conexion->connect_error);
}