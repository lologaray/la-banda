<?php
$servidor = "localhost";
$usuario = "root";
$contrasenia = "";
$base_datos = "la-banda";

$conexion = new mysqli($servidor, $usuario, $contrasenia, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$paquetes = $conexion->query("SELECT * FROM la_banda");
?>
