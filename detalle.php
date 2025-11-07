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
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($paquete['nombre']) ?> - Detalle del Paquete | M Viajes</title>
  <link rel="stylesheet" href="styles_detalle.css">
</head>
<body>

  <header>
    <div class="logo-container">
      <img src="02202fb1-db80-454d-ae25-5203c310d13b.png" alt="Logo M Viajes" class="logo-img">
    </div>
    <h1 class="logo">M Viajes</h1>
    <p>"Explora el mundo, descubre tu próxima aventura"</p>
  </header>

  <main>
    <div class="paquete-detalle">
      <img src="https://picsum.photos/500/350?random=<?= $paquete['id_paquete'] ?>" 
           alt="Imagen del paquete <?= htmlspecialchars($paquete['nombre']) ?>">
      <div class="paquete-info">
        <h2><?= htmlspecialchars($paquete['nombre']) ?></h2>
        <p><?= htmlspecialchars($paquete['descripcion']) ?></p>
        <p class="duracion">Duración: <?= (int)$paquete['duracion_dias'] ?> días</p>
        <p class="precio">Precio: USD <?= number_format($paquete['precio'], 2) ?></p>
        <a href="index.php" class="btn">Volver</a>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 M Viajes - Todos los derechos reservados</p>
  </footer>

</body>
</html>
