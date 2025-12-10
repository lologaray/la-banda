<?php
require_once 'componentes/conexion.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    echo "ID no válido.";
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
")->fetch_assoc();

if (!$paquete) {
    echo "Paquete no encontrado.";
    exit;
}

// Traer servicios asociados
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
    <title><?= $paquete['nombre'] ?> - Detalle</title>
</head>
<body>

<h1><?= $paquete['nombre'] ?></h1>

<p><strong>Descripción:</strong> <?= $paquete['descripcion'] ?></p>
<p><strong>Precio:</strong> USD <?= $paquete['precio'] ?></p>
<p><strong>Duración:</strong> <?= $paquete['duracion_dias'] ?> días</p>
<p><strong>Fecha salida:</strong> <?= $paquete['fecha_salida'] ?></p>
<p><strong>Fecha regreso:</strong> <?= $paquete['fecha_regreso'] ?></p>
<p><strong>Estado:</strong> <?= $paquete['estado'] ?></p>
<p><strong>Cupo:</strong> <?= $paquete['cupo'] ?></p>

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
<ul>
<?php while ($s = $servicios->fetch_assoc()): ?>
    <li>
        <strong><?= $s['nombre'] ?></strong> - USD <?= $s['precio'] ?><br>
        <?= $s['descripcion'] ?>
    </li>
<?php endwhile; ?>
</ul>

<a href="index.php">Volver</a>

</body>
</html>
