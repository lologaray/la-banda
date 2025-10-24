<?php
require_once "componentes/conexion.php";
$paquetes = $conexion->query("
SELECT * 
FROM la_banda
WHERE paquetes.estado = 'Disponible';
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
  </nav>

  <main>
    <section id="about-us">
      <h2>Sobre nuestra agencia</h2>
      <p class="section-description">M Viajes es una agencia especializada en viajes internacionales que te conecta con los destinos más fascinantes del planeta. Creamos experiencias únicas que van más allá del turismo convencional.</p>
      <p class="section-description">Con un equipo de expertos y una red global de socios, ofrecemos paquetes personalizados que se adaptan a tus gustos, tu presupuesto y tus sueños de viajar.</p>
      <p class="section-description">Ya sea que busques playas paradisíacas, ciudades vibrantes o aventuras culturales, M Viajes está aquí para hacer realidad ese viaje inolvidable.</p>
      <img src="https://picsum.photos/500/350?travel" alt="Imagen de viaje" class="hero-img" />
    </section>

    <section id="services">
      <h2>Principales servicios de M Viajes</h2>
      <div class="services-grid">
        <
        <article class="service-card">
          <h3>Viaje a Europa</h3>
          <p>Incluye vuelos, hoteles 4 estrellas, tours guiados por París, Roma y Barcelona.</p>
          <span class="price">USD 2.500</span>
          <button onclick="addToCart('Viaje a Europa', 2500)">Agregar al carrito</button>
        </article>

        <article class="service-card">
          <h3>Caribe todo incluido</h3>
          <p>7 noches en resort frente al mar, comidas y bebidas ilimitadas, excursiones opcionales.</p>
          <span class="price">USD 1.800</span>
          <button onclick="addToCart('Caribe todo incluido', 1800)">Agregar al carrito</button>
        </article>

        <article class="service-card">
          <h3>Aventura en Asia</h3>
          <p>Explora Tailandia, Japón y Vietnam con guías locales y experiencias auténticas.</p>
          <span class="price">USD 3.200</span>
          <button onclick="addToCart('Aventura en Asia', 3200)">Agregar al carrito</button>
        </article>
      </div>
    </section>

    <section class="centered-content">
      <button onclick="toggleInfo()">Más información</button>
    </section>

    <div id="additional-info">
      <h3>Información de Viajes y Contacto</h3>
      <p>Nuestra agencia opera con altos estándares de calidad y seguridad. Todos nuestros paquetes incluyen seguro de viaje básico.</p>
      <p>Puedes contactarnos por teléfono al **+54 9 11 1234-5678** o por correo electrónico a **info@mviajes.com**.</p>
      <p>¡Síguenos en nuestras redes sociales para estar al tanto de las últimas ofertas!</p>
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

  cartIcon.addEventListener('click', () => {
    toggleCart();
  });

  function toggleCart(forceOpen = false) {
    if (forceOpen) {
      cartModal.style.display = 'block';
    } else {
      cartModal.style.display = (cartModal.style.display === 'block') ? 'none' : 'block';
    }
  }

  // cerrar carrito al hacer clic fuera
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
  
</body>
</html>
