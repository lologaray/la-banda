<?php
session_start();
require_once 'componentes/conexion.php';

$paquetes = $conexion->query("
    SELECT * 
    FROM paquete
    WHERE estado = 'Disponible';
");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>M Viajes - Agencia de Viajes Internacionales</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="styles.css" />
</head>
<body>

<header>
  <div class="logo-container">
    <img src="02202fb1-db80-454d-ae25-5203c310d13b.png" alt="Logo M Viajes" class="logo-img">
  </div>

  <div class="cart-icon"><i class="fas fa-shopping-cart"></i></div>

  <h1 class="logo">M Viajes</h1>
  <p>"Explora el mundo, descubre tu próxima aventura"</p>

  <div class="login-section">
    <?php
      if (isset($_SESSION['userid'])) {
          echo "Hola, " . htmlspecialchars($_SESSION['nombre']);
      } else {
          echo "<a href='login.php'>Iniciar Sesión</a>";
      }
    ?>
  </div>
</header>

<div id="cart-modal" class="cart-modal">
  <h3>
    Carrito de compras 
    <span class="close-cart" onclick="toggleCart()">&times;</span>
  </h3>
  <ul id="cart-items"></ul>
  <button onclick="clearCart()">Vaciar carrito</button>
</div>

<nav>
  <a href="sobre-nosotros.html">Sobre Nosotros</a>
  <a href="#services">Servicios</a>
  <a href="#contact">Contacto</a>
  <a href="detalle.php">Detalle</a>
</nav>

<main>

<section id="about-us">
  <h2>Sobre nuestra agencia</h2>
  <p class="section-description">M Viajes es una agencia especializada en viajes internacionales que te conecta con los destinos más fascinantes del planeta.</p>
  <p class="section-description">Con un equipo de expertos y una red global de socios, ofrecemos paquetes personalizados que se adaptan a tus gustos y presupuesto.</p>
  <p class="section-description">Ya sea que busques playas, ciudades vibrantes o aventuras culturales, M Viajes te acompaña.</p>

  <img src="https://picsum.photos/500/350?travel" alt="Imagen de viaje" class="hero-img" />
</section>

<section id="services">
  <h2>Paquetes disponibles</h2>

  <div class="services-grid">
    <?php while($row = $paquetes->fetch_assoc()): ?>
      <article class="service-card">
        <img src="https://picsum.photos/300/200?random=<?= $row['id_paquete'] ?>" 
             alt="Imagen de <?= htmlspecialchars($row['nombre']) ?>">
        
        <h3><?= htmlspecialchars($row['nombre']) ?></h3>
        <p><?= htmlspecialchars($row['descripcion']) ?></p>
        <span class="price">USD <?= number_format($row['precio'], 2) ?></span>

        <button onclick="addToCart('<?= addslashes($row['nombre']) ?>', <?= $row['precio'] ?>)">
          Agregar al carrito
        </button>
      </article>
    <?php endwhile; ?>
  </div>
</section>

<section class="centered-content">
  <button onclick="toggleInfo()">Más información</button>
</section>

<div id="additional-info" style="display:none;">
  <h3>Información de Viajes y Contacto</h3>
  <p>Todos nuestros paquetes incluyen seguro de viaje básico.</p>
  <p>Teléfono: +54 9 11 1234-5678</p>
  <p>Email: info@mviajes.com</p>
</div>

</main>

<footer id="contact">
  <p>&copy; 2025 M Viajes - Todos los derechos reservados</p>
</footer>

<script>
  let cart = [];

  function addToCart(tripName, price) {
    cart.push({ name: tripName, price: price });
    updateCartUI();
    toggleCart(true);
  }

  function updateCartUI() {
    const cartItems = document.getElementById('cart-items');
    cartItems.innerHTML = '';
    let total = 0;

    cart.forEach(item => {
      const li = document.createElement('li');
      li.textContent = `${item.name} - USD ${item.price}`;
      cartItems.appendChild(li);
      total += item.price;
    });

    if (cart.length > 0) {
      const totalLi = document.createElement('li');
      totalLi.style.fontWeight = 'bold';
      totalLi.textContent = `Total: USD ${total}`;
      cartItems.appendChild(totalLi);
    }
  }

  function clearCart() {
    cart = [];
    updateCartUI();
  }

  const cartIcon = document.querySelector('.cart-icon');
  const cartModal = document.getElementById('cart-modal');

  cartIcon.addEventListener('click', () => toggleCart());

  function toggleCart(forceOpen = false) {
    cartModal.style.display = forceOpen ? 'block' :
      (cartModal.style.display === 'block' ? 'none' : 'block');
  }

  window.addEventListener('click', (e) => {
    if (!cartModal.contains(e.target) && !cartIcon.contains(e.target)) {
      cartModal.style.display = 'none';
    }
  });

  function toggleInfo() {
    const infoDiv = document.getElementById('additional-info');
    infoDiv.style.display = (infoDiv.style.display === 'block') ? 'none' : 'block';
  }
</script>

</body>
</html>
