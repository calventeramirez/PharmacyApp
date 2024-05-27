<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - Panel de usuario</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <script src="./JS/api.js"></script> <!-- Script de JavaScript -->
    <script src="JS/fontawesome.min.js" defer></script> <!-- Font Awesome -->
</head>

<body>
    <?php session_start(); ?>
    <header>
        <div class="header-top">
            <a href="/index.php" class="nav-logo"><img id="imagen-nav" src="img/logo_sin_fondo.png" alt="Logo"></a>
            <div class="container">
            <div class="buscador">
                <form action="buscar.php" method="get">
                    <input type="text" name="termino" placeholder="Buscar productos...">
                    <button type="submit"><img src="/img/busqueda.png" alt="Buscar"></button>
                </form>
            </div>
                <div class="cuenta-carrito">
                    <?php
                    // Si el usuario está logueado
                    if (isset($_SESSION['usuario'])) {
                        echo '<a href="./dashboard.php"><img src="/img/avatar.png" alt="Logo" class="icon icon-account" style="width: 30px; height: 30px; margin-right: 5px; "> ' . $_SESSION['usuario'] . '</a>';
                        if ($_SESSION['rol'] == "admin") {
                            echo '<a href="/anadir_medicamentos.php"><img src="/img/anadir-medicamento.png" alt="anadirmMedicamento" style="width: 30px; height: 30px ;">Añadir Medicamento</a>';
                        }
                        echo '<a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px;">Cerrar sesión</a>';
                        echo '<a href="./carrito.php" ><img src="/img/carrito.png" alt="Carrito" style="width: 25px; height: 20px; margin-right: 5px">Carrito</a>';
                    } else { // Si no está logueado
                        echo '<a href="/login.php" class="cuenta"><img src="/img/iniciar-sesion.png" alt="iniciarsesion" style="width: 25px; height: 20px; margin-right: 5px;">Iniciar Sesión</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <nav>
            <ul class="menu-verde">
                <li><a href="/index.php">Inicio</a></li>
                <li><a href="/medicamentos.php">Medicamentos</a></li>
                <li><a href="/contacto.php">Contacto</a></li>
            </ul>
        </nav>
    </header>
    <main class="dashboard">
        <!-- Sección de inicio -->
    <aside class="menu-usuario">
  <h3>Menú</h3>
  <ul>
    <li><a href="/dashboard.php">Resumen de Pedidos</a></li>
    <li><a href="/pedidos.php">Mis pedidos</a></li>
    <li><a href="#">Direcciones</a></li>
  </ul>
  <a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px;">Cerrar sesión</a>
    </aside>
<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost', 'admin', 'admin', 'db_pharmacyapp');

// Comprueba si la conexión ha tenido éxito
if ($conexion->connect_error) {
  die('Error de Conexión (' . $conexion->connect_errno . ') '. $conexion->connect_error);
}

// Obtiene el nombre de usuario de la sesión
$usuario = $_SESSION['usuario'];

// Prepara la consulta SQL
$sql = "SELECT * FROM Pedidos WHERE nick = ?";

// Prepara la declaración
$stmt = $conexion->prepare($sql);

// Vincula los parámetros
$stmt->bind_param('s', $usuario);

// Ejecuta la declaración
$stmt->execute();

// Obtiene los resultados
$resultado = $stmt->get_result();

// Muestra cada pedido en la tabla
echo "<div class='card-pedidos'>";
echo "<h4>Ultimos pedidos</h4>";
while ($pedidos = $resultado->fetch_assoc()) {
  echo "<div class='pedido'>";
  echo "<h4>Pedido #" . $pedidos['idPedido'] . "</h4>";
  echo "<p>Fecha: " . $pedidos['fechaPedido'] . "</p>";
  echo "<p>Total: " . $pedidos['precioTotal'] . " €" ."</p>";
  echo "</div>";
}
echo "</div>";

// Cierra la declaración y la conexión
$stmt->close();


?>
<?php
// Prepara la consulta SQL para obtener los detalles del usuario
$sqlUsuario = "SELECT nick, email FROM Usuarios WHERE nick = ?";

// Prepara la declaración
$stmtUsuario = $conexion->prepare($sqlUsuario);

// Vincula los parámetros
$stmtUsuario->bind_param('s', $usuario);

// Ejecuta la declaración
$stmtUsuario->execute();

// Obtiene los resultados
$resultadoUsuario = $stmtUsuario->get_result();

// Muestra los detalles del usuario en una tarjeta
if ($usuario = $resultadoUsuario->fetch_assoc()) {
  echo "<div class='card-usuario'>";
  echo "<h4>"."Datos Personales"."</h4>";
  echo "<h4>"."Hola " . $usuario['nick'] . "</h4>";
  echo "<p>Correo: " . $usuario['email'] . "</p>";
  echo "</div>";
}

// Cierra la declaración
$stmtUsuario->close();
$conexion->close();
?>

    </main>
    <footer>
        <div class="footer-container">
            <div class="row">
                <div class="col-lg-2">
                    <img src="img/logo_sin_fondo.png" alt="Logo" id="imagen-footer">
                </div>
                <div class="col-lg-7">
                    <p> &copy; Desarrollado por: Pablo Jesús Calvente Ramírez, Fernando Dominguez Lago, Pablo Pérez Iza
                        & Victor
                        Moreno Benítez</p>
                </div>
                <div class="col-lg-2">
                    <p>Enlaces de interés</p>
                    <ul>
                        <li class="footer-li"><a href="/politicaPrivacidad.php">Política de privacidad</a></li>
                        <li class="footer-li"><a href="/terminosCondiciones.php">Términos y condiciones</a></li>
                        <li class="footer-li"><a href="/cookies.php">Política de cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="JS/bootstrap.bundle.min.js"></script> <!-- Bootstrap -->
</body>

</html>