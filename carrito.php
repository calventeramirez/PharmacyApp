<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - PharmacyApp</title>
    <link rel="icon" href="img/favicon.png" type="image/x-icon"> <!-- favicon -->
    <link rel="stylesheet" href="./CSS/estilo.css"> <!-- Hoja de estilos -->
    <link href="CSS/bootstrap.min.css" rel="stylesheet"><!-- Bootstrap -->
    <script src="./JS/api.js"></script> <!-- Script de JavaScript -->
    <script src="JS/fontawesome.min.js" defer></script> <!-- Font Awesome -->
    <?php require "./funciones/conexion_bbdd.php" ?>
</head>

<body>
    <?php 
    session_start();
    if (isset($_SESSION["usuario"])) {
        $usuario = $_SESSION["usuario"];
        $rol = $_SESSION["rol"];
    } else {
        header("Location: /login.php");
    }
    if($rol != "admin" && $rol != "cliente"){
        header("Location: /index.php");
    }
    ?>
    <header>
        <div class="header-top">
            <a href="/index.php" class="nav-logo"><img id="imagen-nav" src="img/logo_sin_fondo.png" alt="Logo"></a>
            <div class="container">
                <div class="buscador">
                    <input type="text" placeholder="Buscar productos...">
                </div>
                <div class="cuenta-carrito">
                    <?php
                    // Si el usuario está logueado
                    if(isset($_SESSION['usuario'])) {
                        echo '<a href="./dashboard.php"><img src="/img/avatar.png" alt="Logo" class="icon icon-account" style="width: 30px; height: 30px; margin-right: 5px;"> '.$_SESSION['usuario'].'</a>';
                        if($_SESSION['rol'] == "admin"){
                            echo '<a href="/anadir_medicamentos.php"><img src="/img/anadir-medicamento.png" alt="anadirmMedicamento" style="width: 30px; height: 30px; margin-right: 5px;">Añadir Medicamento</a>';
                        }
                        echo '<a href="/funciones/cerraSesion.php"><img src="/img/cerrar-sesion.png" alt="cerrarSesión" style="width: 25px; height: 20px; margin-right: 5px">Cerrar sesión</a>';
                        echo '<a href="/carrito.php" ><img src="/img/carrito.png" alt="Carrito" style="width: 25px; height: 20px; margin-right: 5px">Carrito</a>';
                    } else { // Si no está logueado
                        echo '<a href="/login.php" class="cuenta"><img src="/img/iniciar-sesion.png" alt="iniciarsesion" style="width: 25px; height: 20px; margin-right: 5px">Iniciar Sesión</a>';
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
    <div class="container">
        <h2 class="text-center mb-3">Mi carrito</h2>
        <div>
            <table class=" container table table-striped table-hover">
                <thead class="table table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Consulta para obtener medicamentos en la cesta
                    $sql = "SELECT pc.idMedicamento, p.nombre, p.descripcion, p.precio, pc.cantidad, p.imagen FROM medicamentosrecetas pc JOIN medicamentos p ON pc.idMedicamento = p.idMedicamento WHERE pc.idReceta = (SELECT idReceta FROM recetas WHERE usuario = '$usuario')";
                    
                    $resultado = $conn->query($sql);
                    $medicamentos = [];

                    // Creación de objetos medicamentos a partir de los resultados
                    while ($fila = $resultado->fetch_assoc()) {
                        $nuevo_medicamento = new Medicamento(
                            $fila["idMedicamento"],
                            $fila["nombre"],
                            $fila["descripcion"],
                            $fila["precio"],
                            $fila["cantidad"],
                            $fila["imagen"]
                        );
                        array_push($medicamentos, $nuevo_medicamento);
                    }

                    // Mostrar medicamentos en la tabla
                    foreach ($medicamentos as $medicamento) {
                        echo "<tr>";
                        echo "<td>" . $medicamento->nombre . "</td>";
                        echo "<td>" . $medicamento->precio . "</td>";
                        echo "<td>" . $medicamento->descripcion . "</td>";
                        echo "<td>" . $medicamento->cantidad . "</td>";
                    ?>
                        <td>
                            <img witdh="50" height="100" src="<?php echo $medicamento->imagen ?>">
                        </td>
                    <?php
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- Mostrar precio total de la cesta -->
            <?php
            $sql = "SELECT precioTotal FROM recetas WHERE usuario = '$usuario'";
            $resultado = $conexion->query($sql);
            $fila = $resultado->fetch_assoc();
            $precioTotal = $fila['precioTotal'];
            ?>
            <h4>El precio total de la cesta es: <?php echo $precioTotal ?>€</h4>
        </div>
    </main>
    <footer>
        <div class="footer-container">
            <div class="row">
                <div class="col-lg-2">
                    <img src="img/logo_sin_fondo.png" alt="Logo" id="imagen-footer">
                </div>
                <div class="col-lg-7">
                    <p> &copy; Desarrollado por: Pablo Jesús Calvente Ramírez, Fernando Dominguez Lago, Pablo Pérez Iza
                        & Victor Moreno Benítez</p>
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