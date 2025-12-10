<?php
require_once 'componentes/conexion.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo "<div class='alert alert-danger text-center mt-5'>ID no válido.</div>";
    exit;
}


$paquete = $conexion->query("
    SELECT p.*, 
           d.nombres AS destino,
           d.pais,
           c.tipo AS categoria,
           promo.tipo AS promo_tipo,
           promo.descuento AS promo_descuento
    FROM paquete p
    INNER JOIN destino d ON p.id_destino = d.id_destino
    LEFT JOIN categoria c ON p.id_categoria = c.id_categoria
    LEFT JOIN promocion promo ON p.id_promocion = promo.id_promocion
    WHERE p.id_paquete = $id
      AND (p.estado = 'Disponible' OR p.estado = 'Proximamente')
")->fetch_assoc();

if (!$paquete) {
    echo "<div class='alert alert-danger text-center mt-5'>
            Paquete no encontrado o no disponible.
          </div>";
    exit;
}


$servicios = $conexion->query("
    SELECT s.*
    FROM servicio s
    INNER JOIN paquete_servicio ps ON s.id_servicio = ps.id_servicio
    WHERE ps.id_paquete = $id
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($paquete['nombre']) ?> - Detalle del Paquete | M Viajes</title>
  <link rel="stylesheet" href="style_detalle.css">
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

        <h3>Destino</h3>
        <p><?= $paquete['destino'] ?> (<?= $paquete['pais'] ?>)</p>

        <h3>Categoría</h3>
        <p><?= $paquete['categoria'] ?: 'Sin categoría' ?></p>

        <h3>Promoción</h3>
        <?php if ($paquete['promo_tipo']): ?>
            <p><?= $paquete['promo_tipo'] ?> - Descuento: USD <?= $paquete['promo_descuento'] ?></p>
        <?php else: ?>
            <p>Sin promoción</p>
        <?php endif; ?>

        <h3>Servicios incluidos</h3>
        <ul class="servicios-lista">
        <?php while ($s = $servicios->fetch_assoc()): ?>
            <li>
                <strong><?= $s['nombre'] ?></strong> - USD <?= $s['precio'] ?><br>
                <?= $s['descripcion'] ?>
            </li>
        <?php endwhile; ?>
        </ul>

        <a href="index.php" class="btn">Volver</a>
      </div>
    </div>
</main>

<footer>
    <p>&copy; 2025 M Viajes - Todos los derechos reservados</p>
</footer>

</body> 
</html>
