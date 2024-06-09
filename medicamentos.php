<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmacyApp - La mejor farmacia a tu mano</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <?php include "./funciones/conexion_bbdd.php" ?>
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
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
    <main>

        <?php
        // Obtenemos los medicamentos de la base de datos
        $sql = "SELECT * FROM medicamentos";

        // Ejecutamos la consulta y la guardamos en $resultado
        $resultado = $conn->query("SELECT * FROM medicamentos");


        // Comprueba si el carrito ya existe, si no, lo crea
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = array();
        }

        // Si se ha pulsado el botón "Añadir"
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['añadir'])) {
            // Añade el producto al carrito
            $id_Medicamento = $_POST['idMedicamento'];
            $_SESSION['carrito'][$id_Medicamento] = $idMedicamento;
        }
        
        // Comienzo del contenedor de la fila
        echo "<div class='medicamentos-container'>";

        // Muestra cada producto en la tabla
        while ($producto = $resultado->fetch_assoc()) {
            echo "<div class='col-md-3 my-2'>";
            echo "<div class='card h-100'>";
            echo "<img class='card-img-top' src='" . $producto['imagen'] . "' alt='Imagen'>";
            echo "<div class='card-body flex-column'>";
            echo "<h5 class='card-title'>" . $producto['nombre'] . "</h5>";
            $descripcion = $producto['descripcion'];
            $palabras = explode(' ', $descripcion);
            /* Condicion para poner '...' cuando se cuenten mas de 11 palabras en la descripcion de los medicamentos */
            if (str_word_count($descripcion) > 11) {
            $descripcion = implode(' ', array_slice($palabras, 0, 11)) . '...';
            }
            echo "<p class='card-text flex-grow-1'>" . $descripcion . "</p>";
            echo "<p class='card-text'>Precio: " . $producto['precio'] . '€' . "</p>";
            if (isset($_SESSION['usuario'])) { ?>
            <form method="post" action="./funciones/anadir_carrito.php">
                <input type="hidden" name="idMedicamento" value="<?php echo $producto['idMedicamento']; ?>">
                <button class='add-to-cart'><img src='/img/anadir-al-carrito.png' alt='Añadir al carrito' style='width: 20px; height: 20px; margin-right: 5px'>Añadir</button>
            </form>
        <?php
            }
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
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