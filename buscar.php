<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - La mejor farmacia a tu mano</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!--JavaScript for Carousel -->
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
            </div>
                <div class="cuenta-carrito">
                    <?php
                    // Si el usuario está logueado
                    if (isset($_SESSION['usuario'])) {
                        echo '<a href="./dashboard.php"><img src="/img/avatar.png" alt="Logo" class="icon icon-account" style="width: 30px; height: 30px; margin-right: 2px;"> ' . $_SESSION['usuario'] . '</a>';
                        if ($_SESSION['rol'] == "admin") {
                            echo '<a href="/anadir_medicamentos.php"><img src="/img/anadir-medicamento.png" alt="anadirmMedicamento" style="width: 30px; height: 30px; margin-right: 2px;">Añadir Medicamento</a>';
                        }
                        echo '<a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px; margin-right: 2px">Cerrar sesión</a>';
                        echo '<a href="./carrito.php" ><img src="/img/carrito.png" alt="Carrito" style="width: 25px; height: 20px; margin-right: 5px">Carrito</a>';
                    } else { // Si no está logueado
                        echo '<a href="/login.php" class="cuenta"><img src="/img/iniciar-sesion.png" alt="iniciarsesion" style="width: 25px; height: 20px; margin-right: 2px">Iniciar Sesión</a>';
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
    <main>
    <section class="salud">
        <h2>Resultados de la búsqueda</h2>
        <?php
        $termino = $_GET['termino'];

        // Conexión a la base de datos
        $conexion = new mysqli('localhost', 'admin', 'admin', 'db_pharmacyapp');

        if ($conexion->connect_error) {
            die("La conexión a la base de datos ha fallado: " . $conexion->connect_error);
        }
        // Controlamos de que no traiga ninguna información si no se ha introducido nada en el buscador
        if (!empty($termino)) {
            $sql = "SELECT * FROM medicamentos WHERE nombre LIKE '%$termino%'";
            $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            echo "<div class='row'>";
            while($row = $resultado->fetch_assoc()) {
                echo "<div class='col-lg-3 mb-4'>";
                echo "<div class='card h-100'>";
                echo "<img class='card-img-top' src='" . $row["imagen"] . "' alt='Imagen'>";
                echo "<div class='card-body d-flex flex-column'>";
                echo "<h5 class='card-title'>" . $row["nombre"] . "</h5>";
                echo "<p class='card-text flex-grow-1'>" . $row["descripcion"] . "</p>";
                echo "<p class='card-text'>Precio: " . $row["precio"] . '€' . "</p>";
                if (isset($_SESSION['usuario'])) {
                    echo '<form method="post" action="./funciones/anadir_carrito.php">';
                    echo '<input type="hidden" name="idMedicamento" value="' . $row['idMedicamento'] . '">';
                    echo '<button class="add-to-cart"><img src="/img/anadir-al-carrito.png" alt="Añadir al carrito" style="width: 20px; height: 20px; margin-right: 5px">Añadir</button>';
                    echo '</form>';
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<p>No se encontraron resultados para '$termino'</p>";
        }
    } else {
        echo "<p>Por favor, introduce un término de búsqueda.</p>";
    }
        $conexion->close();
        ?>
    </section>
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
                <div class="col-lg-3">
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