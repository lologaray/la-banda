<?php
$paquetes = $conexion->query("SELECT * FROM la_banda");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>M Viajes - Agencia de Viajes Internacionales</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
      --color-primary: darkolivegreen;
      --color-secondary: olive;
      --color-background: #fdf6e3;
      --color-light: #fff;
      --color-dark: #333;
      --font-family-base: Arial, sans-serif;
    }

    body {
      background-color: var(--color-background);
      font-family: var(--font-family-base);
      color: var(--color-dark);
      margin: 0;
      padding: 0;
    }

    header {
      background-color: var(--color-primary);
      color: var(--color-light);
      padding: 20px 40px;
      text-align: center;
      position: relative;
    }

    header .logo {
      font-size: 2.5em;
      font-weight: bold;
      margin: 0;
    }

    header p {
      margin-top: 5px;
      font-style: italic;
    }

    .cart-icon {
      position: absolute;
      right: 20px;
      top: 20px;
      font-size: 24px;
      cursor: pointer;
    }

    nav {
      background-color: var(--color-secondary);
      padding: 10px;
      text-align: center;
    }

    nav a {
      color: var(--color-light);
      text-decoration: none;
      padding: 10px 15px;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    nav a:hover {
      background-color: var(--color-primary);
    }

    main {
      padding: 20px;
      max-width: 1100px;
      margin: 0 auto;
    }

    h1, h2 {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 20px;
    }

    .section-description {
      text-align: center;
      max-width: 700px;
      margin: 0 auto 30px auto;
      line-height: 1.6;
    }

    .hero-img {
      display: block;
      margin: 30px auto;
      width: 100%;
      max-width: 500px;
      height: auto;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .services-grid {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 25px;
    }

    .service-card {
      background-color: var(--color-light);
      border: 1px solid #ccc;
      border-radius: 10px;
      width: 100%;
      max-width: 350px;
      padding: 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 15px rgba(0,0,0,0.15);
    }

    .service-card h3 {
      color: var(--color-primary);
      margin-top: 0;
    }
    
    .price {
      font-size: 1.5em;
      font-weight: bold;
      color: var(--color-secondary);
      display: block;
      margin: 15px 0;
    }

    .service-card button {
      background-color: var(--color-primary);
      color: var(--color-light);
      padding: 12px 25px;
      margin-top: 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 1em;
      transition: background-color 0.3s ease;
    }

    .service-card button:hover {
      background-color: var(--color-secondary);
    }

    .centered-content {
      text-align: center;
      margin: 40px 0;
    }
    
    #additional-info {
      display: none;
      max-width: 800px;
      margin: 30px auto;
      text-align: center;
      background-color: #f0f0f0;
      padding: 30px;
      border-radius: 10px;
      box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
      animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    footer {
      background-color: var(--color-primary);
      color: var(--color-light);
      text-align: center;
      padding: 20px;
      margin-top: 50px;
    }

    @media (max-width: 768px) {
      .services-grid {
        flex-direction: column;
        align-items: center;
      }

      nav a {
        display: block;
        border-bottom: 1px solid var(--color-primary);
      }
    }

    .cart-modal {
      position: fixed;
      right: 20px;
      top: 80px;
      width: 300px;
      background-color: var(--color-light);
      border: 1px solid #ccc;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      border-radius: 10px;
      padding: 20px;
      display: none;
      z-index: 1000;
      animation: fadeIn 0.3s ease-in-out;
    }

    .cart-modal h3 {
      margin-top: 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .cart-modal ul {
      list-style: none;
      padding: 0;
      margin: 10px 0;
      max-height: 200px;
      overflow-y: auto;
    }

    .cart-modal ul li {
      border-bottom: 1px solid #ddd;
      padding: 8px 0;
      font-size: 0.95em;
    }

    .cart-modal button {
      background-color: var(--color-secondary);
      color: var(--color-light);
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.9em;
      margin-top: 10px;
      width: 100%;
    }

    .cart-modal button:hover {
      background-color: var(--color-primary);
    }

    .close-cart {
      cursor: pointer;
      font-size: 1.2em;
      color: var(--color-dark);
    }

    @media (max-width: 600px) {
      .cart-modal {
        right: 0;
        left: 0;
        width: 100%;
        top: auto;
        bottom: 0;
        border-radius: 20px 20px 0 0;
      }
    }
  </style>
</head>
<body>

  <header>
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
  <?php?>
</body>
</html>
