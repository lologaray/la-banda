<?php
require_once 'componentes/conexion.php';

$errores = '';
$succes = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingresar'])) {

    $correo = $conexion->real_escape_string($_POST['nombre-usuario'] ?? '');
    $contraseña = $conexion->real_escape_string($_POST['contraseña'] ?? '');

    if (empty($correo) || empty($contraseña)) {
        $errores .= "<div class='alert alert-danger'>Por favor complete todos los campos.</div>";
    } else {
        $query = $conexion->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->bind_param('s', $correo);
        $query->execute();
        $resultado = $query->get_result();

        if ($resultado->num_rows > 0) {
            $errores .= "<div class='alert alert-danger'>El correo ya está registrado.</div>";
        } else {
            $contra_hash = password_hash($contraseña, PASSWORD_BCRYPT);
            $query = $conexion->prepare("INSERT INTO usuario (email, contraseña) VALUES (?, ?)");
            $query->bind_param("ss", $correo, $contra_hash);
            $sentencia = $query->execute();

            if ($sentencia) {
                $succes = "
                <div class='alert alert-success'>
                    Registro exitoso.  
                    <a href='login.php' class='alert-link'>Haz clic aquí para iniciar sesión</a>
                </div>";
            } else {
                $errores .= "<div class='alert alert-danger'>Error en la base de datos, pruebe más tarde.</div>";
            }
        }

        $query->close();
        $conexion->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>

<style>
/* ============================
   VARIABLES Y ESTILO GLOBAL
   ============================ */
:root {
  --color-primary: darkolivegreen;
  --color-primary-dark: #3a4b2f;
  --color-secondary: olive;
  --color-background: #f1f0e6;
  --color-light: #fff;
  --color-dark: #222;
  --font-family-base: Arial, sans-serif;
}

body {
  background: linear-gradient(135deg, #f5f3e7 0%, #e8e6d4 40%, #dce1c5 100%);
  font-family: var(--font-family-base);
  color: var(--color-dark);
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

/* ============================
   CONTENEDOR DEL FORMULARIO
   ============================ */
.card {
  background-color: var(--color-light);
  padding: 40px;
  border-radius: 12px;
  border: 1px solid var(--color-primary-dark);
  width: 100%;
  max-width: 400px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.22);
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  text-align: center;
  margin-top: 20px;
}

.card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 22px rgba(0,0,0,0.25);
}

.card h2 {
  color: var(--color-primary-dark);
  margin-bottom: 20px;
  font-size: 1.8em;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* ============================
   INPUTS
   ============================ */
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 12px;
  margin: 12px 0;
  border: 1px solid var(--color-primary);
  border-radius: 6px;
  background-color: #f9f9f5;
  transition: 0.3s ease;
  font-size: 1em;
}

input[type="email"]:focus,
input[type="password"]:focus {
  border-color: var(--color-primary-dark);
  background-color: #f3f7ef;
  outline: none;
}

/* ============================
   BOTÓN
   ============================ */
button,
.btn-primary {
  background: var(--color-primary-dark);
  color: var(--color-light);
  padding: 12px 25px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 1em;
  width: 100%;
  transition: background-color 0.3s ease;
  margin-top: 10px;
  font-weight: bold;
}

button:hover,
.btn-primary:hover {
  background-color: var(--color-primary);
}

/* ============================
   ENLACES
   ============================ */
a {
  color: var(--color-primary-dark);
  text-decoration: none;
  font-weight: bold;
}

a:hover {
  text-decoration: underline;
  color: var(--color-primary);
}

/* ============================
   ALERTAS
   ============================ */
.alert {
  padding: 12px 15px;
  border-radius: 6px;
  margin-bottom: 15px;
  width: 100%;
  max-width: 400px;
}

.alert-danger {
  background-color: rgba(176, 20, 20, 0.15);
  border: 1px solid rgba(176, 20, 20, 0.35);
  color: #611;
}

.alert-success {
  background-color: #d5f1d0;
  border: 1px solid #7bbf6a;
  color: #234d1e;
}

.alert-link {
  color: var(--color-primary-dark);
}
</style>

</head>

<body>

    <!-- Mostrar errores -->
    <?php if (!empty($errores)) echo $errores; ?>

    <!-- Mostrar éxito -->
    <?php if (!empty($succes)) echo $succes; ?>

    <!-- Formulario de registro -->
    <div class="card">
        <h2>Crear cuenta</h2>

        <form method="POST">
            <label for="correo">Correo</label>
            <input type="email" name="nombre-usuario" id="correo" required>

            <label for="contraseña">Contraseña</label>
            <input type="password" name="contraseña" id="contraseña" required>

            <button type="submit" name="ingresar">Registrarse</button>

            <p class="mt-3">
                ¿Ya tienes cuenta?
                <a href="login.php">Iniciar sesión</a>
            </p>
        </form>
    </div>

</body>
</html>
