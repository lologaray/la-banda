<?php
require_once 'componentes/conexion.php';

$id_paquete = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_paquete > 0) {

   $paquete = $conexion->query("
      SELECT *
      FROM paquete
      WHERE id_paquete = $id_paquete
      AND (estado = 'Disponible' OR estado = 'Proximamente')
   ")->fetch_assoc();

   if (!$paquete) {
      echo "<div class='alert alert-danger text-center mt-5'>
               Paquete no encontrado o no disponible.
            </div>";
      exit;
   }

} else {
   echo "<div class='alert alert-warning text-center mt-5'>
            ID de paquete no válido.
         </div>";
   exit;
}
?>
